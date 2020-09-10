<?php


namespace Laurel\CMS\Core\Responses;


class ServiceResponse
{
    protected int $code;
    protected bool $status;
    protected array $data;
    protected string $message;

    public function __construct(int $code, bool $status, array $data = [], string $message = '')
    {
        $this->code = $code;
        $this->status = $status;
        $this->data = $data;
        $this->message = $message;
    }

    public function getCode() : int
    {
        return $this->code;
    }

    public function getStatus() : bool
    {
        return $this->status;
    }

    public function getData() : array
    {
        return $this->data;
    }

    public function getMessage() : string
    {
        return $this->message;
    }

    public function toArray() : array
    {
        return [
            'code' => $this->code,
            'status' => $this->status,
            'data' => $this->data,
            'message' => $this->message
        ];
    }
}
