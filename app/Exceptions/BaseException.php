<?php
/**
 * Created by PhpStorm.
 * User: Tavv
 * Date: 16/11/2016
 * Time: 2:11 CH
 */

namespace App\Exceptions;


use Exception;

/**
 * Class ApiException
 * @package App\Exceptions
 */
abstract class BaseException extends Exception
{
    protected $id;

    protected $status;

    protected $title;

    protected $detail;

    public function __construct($message)
    {
        parent::__construct($message);
    }

    /**
     * @return mixed
     */
    protected function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    protected function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    protected function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    protected function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    protected function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    protected function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    protected function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param mixed $detail
     */
    protected function setDetail($detail)
    {
        $this->detail = $detail;
    }


    /**
     * Build the Exception
     *
     * @param array $args
     * @return string
     */
    protected function build(array $args)
    {
        $this->id = array_shift($args);

        $error = config(sprintf('errors.%s', $this->id));

        $this->title  = $error['title'];
        $this->detail = vsprintf($error['detail'], $args);

        return $this->detail;
    }


    protected function toArray(){
        return [
            'id' => $this->id,
            'status' => $this->status,
            'title' => $this->title,
            'detail' => $this->detail
        ];
    }

}