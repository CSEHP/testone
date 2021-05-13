<?php
namespace myframe;

use Exception;

class Model
{
    protected $db;
    protected $table = '';
    protected $options;
    /**
     * @description: Model对象的初始化操作
     */
    public function __construct()
    {
        $this->db = DB::getInstance();
        $this->initTable();
        $this->resetOption();
    }
    /**
     * @description: 初始化表名，子类如果没有设置Table属性，则将当前的类名转换为表名
     */
    protected function initTable()
    {
        if ($this->table === '') {
            $className = basename(str_replace('\\', '/', get_class($this)));
            $this->table = strtolower($className);
            $this->table = $this->db->getConfig('prefix') . $this->table;
        }
    }
    /**
     * @description: 重置options属性
     */
    protected function resetOption()
    {
        $this->options = [
            'where' => '',      // WHERE子句
            'order' => '',      // ORDER BY子句
            'limit' => '',      // LIMIT子句
            'data' => []        // WHERE中的数据部分
        ];
    }
    /**
     * @description: 拼接Select语句
     * @param {array} $field 查询的字段列表
     * @return {string} 查询语句的SQL模板
     */
    protected function buildSelect(array $field = [])
    {
        $field = empty($field) ? '*' : ('`' . implode('`,`', $field) . '`');
        $table = $this->table;
        $where = $this->options['where'];
        $order = $this->options['order'];
        $limit = $this->options['limit'];
        return "SELECT $field FROM `$table` $where $order $limit";
    }
    /**
     * @description: 获取多条数据
     * @param {array} $field 查询的字段列表
     * @return {array} 多行数据
     */
    public function get(array $field = [])
    {
        $sql = $this->buildSelect($field);
        $data = $this->db->fetchAll($sql, $this->options['data']);
        $this->resetOption();
        return $data;
    }
    /**
     * @description: 获取一条数据
     * @param {array} $field 查询的字段列表
     * @return {array} 一行数据
     */
    public function first(array $field = [])
    {
        if (!$this->options['limit']) {
            $this->limit(1);
        }
        $sql = $this->buildSelect($field);
        $data = $this->db->fetchRow($sql, $this->options['data']);
        $this->resetOption();
        return $data;
    }
    /**
     * @description: 获取字段值
     * @param {string} $field 查询的字段
     * @return {array} 字段值
     */
    public function value($field)
    {
        $res = $this->first([$field]);
        return $res ? $res[$field] : null;
    }
    /**
     * @description: 拼接where子句（AND连接多个条件）
     * @param {array|string} $field 字段
     * @param {string} $op 操作符
     * @param {mixed} $value 值
     * @return {static} 当前类的对象
     */
    public function where($field, $op = '=', $value = null)
    {
        $this->buildWhere($field, $op, $value, 'AND');
        return $this;
    }
    /**
     * @description: 拼接where子句（OR连接多个条件）
     * @param {array|string} $field 字段
     * @param {string} $op 操作符
     * @param {mixed} $value 值
     * @return {static} 当前类的对象
     */
    public function orWhere($field, $op = '=', $value = null)
    {
        $this->buildWhere($field, $op, $value, 'OR');
        return $this;
    }
    /**
     * @description: 拼接where子句
     * @param {string|array} $field 字段|字段和值键值对组成的数组
     * @param {string|mixed} $op 操作符|值
     * @param {mixed} $value 值
     * @param {string} $join 多个条件的连接符
     */
    protected function buildWhere($field, $op, $value, $join = 'AND')
    {
        //field是数组则表示有多个条件，循环调用buildwhere()拼接where子句
        if (is_array($field)) {
            foreach ($field as $k => $v) {
                $this->buildWhere($k, $op, $v, $join);
            }
            return;
        } elseif (is_null($value)) { //v传递的值是null则op参数表示值，操作符为“=”
            $value = $op;
            $op = '=';
        }
        //拼接where子句
        //如果还没有where子句则where子句以where关键字开始，否则使用连接符连接
        if (empty($this->options['where'])) {
            $join = 'WHERE';
        }
        $this->options['where'] .= "$join `$field` $op ?";
        $this->options['data'][] = $value;
    }
    /**
     * @description: 拼接order子句
     * @param {string} $field 待排序字段
     * @param {string} $sort 排序方式
     * @return {static} 当前类的对象
     */
    public function orderBy($field, $sort = 'ASC')
    {
        $this->options['order'] = "ORDER BY `$field` $sort";
        return $this;
    }
    /**
     * @description: 拼接order子句
     * @param {int} $offset 偏移量
     * @param {int} $limit 限制的条数
     * @return {static} 当前类的对象
     */
    public function limit($offset, $limit = '')
    {
        if ($limit) {
            $limit = ", $limit";
        }
        $this->options['limit'] = 'LIMIT ' . $offset . $limit;
        return $this;
    }
    /**
     * @description: 拼接insert语句
     * @param {array} $field 字段数组
     * @param {int} $count 新增的条数
     * @return {string} 插入语句的SQL模板
     */
    protected function buildInsert(array $field = [], $count = 1)
    {
        // 根据字段的个数，生成指定数量的“?”占位符
        $value = array_fill(0, count($field), '?');
        // 将值拼接成“(?,?)”的形式
        $value = '(' . implode(',', $value) . ')';
        // 根据插入的条数$count，将值拼接成“(?,?),(?,?)”的形式
        $value = implode(',', array_fill(0, $count, $value));
        $field = '`' . implode('`,`', $field) . '`';
        $table = $this->table;
        return "INSERT INTO `$table` ($field) VALUES $value";
    }
    /**
     * @description: 新增数据
     * @param {array} $data 一条或多条要插入的记录
     * @return {int} 影响行数
     */
    public function insert(array $data = [])
    {
        if (isset($data[0]) && is_array($data[0])) {
            // 一次新增多条数据
            $sql = $this->buildInsert(array_keys($data[0]), count($data));
            // 将二维数组转为一维数组
            $data = array_reduce($data, function ($carry, $item) {
                return array_merge($carry, array_values($item));
            }, []);
        } else { // 一次新增一条数据
            $sql = $this->buildInsert(array_keys($data));
            $data = array_values($data);
        }
        $res = $this->db->execute($sql, $data);
        $this->resetOption();
        return $res;
    }
    /**
     * @description: 新增数据
     * @param {array} $data 一条或多条要插入的记录
     * @return {int} 最后插入的ID
     */
    public function insertGetId(array $data = [])
    {
        $this->insert($data);
        return $this->db->lastInsertId();
    }
    /**
     * @description: 拼接update语句
     * @param {array} $fields 字段列表
     * @return {string} 更新语句的SQL模板
     */
    protected function buildUpdate(array $fields = [])
    {
        $field = implode(',', array_map(function ($v) {
            return "`$v`=?";
        }, $fields));
        $table = $this->table;
        $where = $this->options['where'];
        $order = $this->options['order'];
        $limit = $this->options['limit'];
        return "UPDATE `$table` SET $field $where $order $limit";
    }
    /**
     * @description: 更新数据
     * @param {array} $data 要更新的字段和值键值对组成的数组
     * @return {int} 影响的行数
     */
    public function update(array $data = [])
    {
        if (empty($this->options['where'])) {
            throw new Exception('update()缺少WHERE条件。');
        }
        $sql = $this->buildUpdate(array_keys($data));
        // 将要修改的数据和WHERE中的数据合并
        $data = array_merge(array_values($data), $this->options['data']);
        $res = $this->db->execute($sql, $data);
        $this->resetOption();
        return $res;
    }
    /**
     * @description: 拼接delete语句
     * @return {string} 删除语句的SQL模板
     */
    protected function buildDelete()
    {
        $table = $this->table;
        $where = $this->options['where'];
        $order = $this->options['order'];
        $limit = $this->options['limit'];
        return "DELETE FROM `$table` $where $order $limit";
    }
    /**
     * @description: 删除数据
     * @return {int} 影响的行数
     */
    public function delete()
    {
        if (empty($this->options['where'])) {
            throw new Exception('delete()缺少WHERE条件。');
        }
        $sql = $this->buildDelete();
        $res = $this->db->execute($sql, $this->options['data']);
        $this->resetOption();
        return $res;
    }
    /**
     * @description: 获取当前表的记录数
     * @return {int} 当前表的记录数
     */
    public function count()
    {
        $table = $this->table;
        $where = $this->options['where'];
        $sql = "SELECT COUNT(*) AS c FROM $table $where";
        $res = $this->db->fetchRow($sql, $this->options['data']);
        $this->resetOption();
        return $res ? $res['c'] : null;
    }
    /**
     * @description: 对某一字段的值进行累加
     * @param {string} $field 字段
     * @param {int} $add 累加值
     * @return {int} 影响的行数
     */
    public function increment($field, $add = 1)
    {
        $table = $this->table;
        $where = $this->options['where'];
        $order = $this->options['order'];
        $limit = $this->options['limit'];
        $sql = "UPDATE `$table` SET `$field`=`$field`+$add $where $order $limit";
        $res = $this->db->execute($sql, $this->options['data']);
        $this->resetOption();
        return $res;
    }
}
