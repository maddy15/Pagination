<?php
namespace App\Pagination;

use Iterator;
use App\Pagination\Meta;

class PageIterator implements Iterator
{
    protected $pages;

    protected $meta;

    protected $position = 0;

    public function __construct(array $pages,Meta $meta)
    {
        $this->pages = $pages;
        $this->meta = $meta;
    }

    public function current()
    {
        return $this->pages[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
       ++$this->position;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function valid()
    {
        return isset($this->pages[$this->position]);
    }

    public function isCurrent(){
        return $this->current() == $this->meta->page;
    }

    public function hasPrevious(){
        return $this->meta->page > 1;
    }

    public function hasNext(){
        return $this->meta->page < $this->meta->lastPage;
    }
}