<?php
namespace App\Pagination;

class Meta{

    protected $page;
    protected $perPage;
    protected $total;

    public function __construct($page,$perPage,$total)
    {
        $this->page = $page;
        $this->perPage = $perPage;
        $this->total = $total;
    }

    public function page(){
        return (int) $this->page;
    }

    public function perPage(){
        return (int) $this->perPage;
    }

    public function total(){
        return (int) $this->total;
    }

    public function lastPage(){
        return (int) ceil($this->total() / $this->perPage());
    }

    public function __get($property){

        if(method_exists($this,$property)){
            return $this->{$property}();
        }

        return null;
    }
}
