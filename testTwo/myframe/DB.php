<?php
/*
 * @Author: your name
 * @Date: 2021-04-24 11:16:13
 * @LastEditTime: 2021-04-27 09:03:55
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
        'dbname' => 'stum',
        'charset' => 'utf8',
        'user' => 'root',
        'pwd' => 'WAN123'
    ];
    protected static $instance;
    // 构造函数 传入配置参数 去实例化 一个 pdo对象
    public function __construct(array $config = [])
    {
        $this->config = array_merge($this->config, $config);
        $this->initPDO();
    }
    // 初始化pdo 对象的方法
    public function initPDO()
    {
        $type = $this->config['type'];
        $host = $this->config['host'];
        $port = $this->config['port'];
        $dbname = $this->config['dbname'];
        $charset = $this->config['charset'];
        $user =$this->config['user'];
        $pwd= $this->config['pwd'];

        $dsn = "$type:host=$host;port=$port;dbname=$dbname;charset=$charset";
        try {
            $this->pdo = new PDO($dsn, $user, $pwd);
        } catch (PDOException $e) {
            throw new Exception('连接数据库失败：'.$e.getMessage());
        }
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    // 初始化配置参数
    public static function init(array $config = [])
    {
        static::$initConfig = $config;
    }
    /**
     * 查询 单条数据方法
     * 参数 $sql 传入sql 语句
     * 参数 $bind ：sql执行时需要的参数
     *
     */
    public function fetchRow($sql, array $bind = [])
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
     * 查询 全部数据方法
     * 参数 $sql 传入sql 语句
     * 参数 $bind ：sql执行时需要的参数
     *
     */
    public function fetchAll($sql, array $bind = [])
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
     * 非查询类方法
     * 参数 $sql 传入sql 语句
     * 参数 $bind ：sql执行时需要的参数
     *
     */
    public function execute($sql, array $bind = [])
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
     * 异常信息获取方法
     * 参数 $e 传入sql 语句
     * 参数 $sql  非必传参数
     * 返回一个 错误信息
     *
     */
    protected function errorMsg($e, $sql = '')
    {
        $msg = $e->getMessage();
        if ($sql != '') {
            $msg .= 'SQL语句执行失败：'.$sql;
        }
        return $msg;
    }
    
    //初始化一个 $initConfig
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static(self::$initConfig);
        }
        return self::$instance;
    }
}
