<?php
/*
 * @Author: your name
 * @Date: 2021-04-24 11:16:13
 * @LastEditTime: 2021-05-05 22:37:23
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /myframe/myframe/DB.php
 */
namespace myframe;

use PDO;
use PDOException;
use Exception;

class DB
{
    protected static $initConfig = [];
    protected $pdo;
    protected $config = [
        'type' => 'mysql',
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => '',
        'charset' => 'utf8',
        'user' => 'root',
        'pwd' => ''
    ];
    protected static $instance;
    /**
     * @description: 初始化数据库配置和连接
     * @param {array} $config 数据库的配置信息
     */
    public function __construct(array $config = [])
    {
        $this->config = array_merge($this->config, $config);
        $this->initPDO();
    }
    /**
     * @description: 初始化数据库连接
     */
    public function initPDO()
    {
        $type = $this->config['type'];
        $host = $this->config['host'];
        $port = $this->config['port'];
        $dbname = $this->config['dbname'];
        $charset = $this->config['charset'];
        $user = $this->config['user'];
        $pwd = $this->config['pwd'];
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
        try {
            $this->pdo = new PDO($dsn, $user, $pwd);
        } catch (PDOException $e) {
            throw new Exception('连接数据库失败：'.$e->getMessage());
        }
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    /**
     * @description: 保存数据库配置信息
     * @param {array} $config 数据库的配置信息
     */
    public static function init(array $config = [])
    {
        static::$initConfig = $config;
    }
    /**
     * @description: 获取数据库配置
     * @param {string} $name 配置项
     * @return {mixed} 配置项的值
     */
    public function getConfig($name = null)
    {
        return $name ? $this->config[$name] : $this->config;
    }
    /**
     * @description: 获取查询结果中的一行数据
     * @param {string} $sql 查询SQL模板
     * @param {Array} $bind  SQL模板中参数绑定的数据
     * @return {Array} 一行数据
     */
    public function fetchRow($sql, Array $bind = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($bind);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            throw new Exception($this->errorMsg($e, $sql));
        }
    }
    /**
     * @description: 获取查询结果中的所有数据
     * @param {String} $sql 查询SQL模板
     * @param {Array} $bind SQL模板中参数绑定的数据
     * @return {Array} 多行数据
     */
    public function fetchAll($sql, Array $bind = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($bind);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            throw new Exception($this->errorMsg($e, $sql));
        }
    }
    /**
     * @description: 执行SQL语句
     * @param {String} $sql 查询SQL模板
     * @param {Array} $bind SQL模板中参数绑定的数据
     * @return {int} 影响行数
     */
    public function execute($sql, Array $bind = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($bind);
            $rowCount = $stmt->rowCount();
            return $rowCount;
        } catch (PDOException $e) {
            throw new Exception($this->errorMsg($e, $sql));
        }
    }
    /**
     * @description: 获取最后插入的ID
     * @return {int} 最后插入的ID
     */
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
    /**
     * @description: 获取错误信息
     * @param {PDOException} $e 异常对象
     * @param {String} $sql 发生异常的SQL语句
     * @return {String} 错误信息
     */
    protected function errorMsg($e, $sql = '')
    {
        $msg = $e->getMessage();
        if ($sql != '') {
            $msg .= 'SQL语句执行失败：'.$sql;
        }
        return $msg;
    }
    /**
     * @description: 获取当前类的实例
     * @return {Static} 当前类的实例
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static(self::$initConfig);
        }
        return self::$instance;
    }
}
