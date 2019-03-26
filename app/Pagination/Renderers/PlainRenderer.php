<?php
namespace App\Pagination\Renderers;

use App\Pagination\Meta;
use App\Pagination\Renderers\RendererAbstract;

class PlainRenderer extends RendererAbstract
{

    public function render(array $extra = [])
    {
       $iterator = $this->pages();

       $html = '<ul>';

       if($iterator->hasPrevious()){

        $html .= '<li>
        <a href="'. $this->query($this->meta->page - 1,$extra) .'">Previous</a>
        </li>';
        }

        foreach($iterator as $page) {
            

            if($iterator->isCurrent()){

                $html .= '<strong><li>
                <a href="'. $this->query($page,$extra) .'">'. $page .'</a>
                </li></strong>';
            }

            else{
                $html .= '<li>
                <a href="'. $this->query($page,$extra) .'">'. $page .'</a>
                </li>';
            }
           
        }

        if($iterator->hasNext()){

            $html .= '<li>
            <a href="'. $this->query($this->meta->page + 1,$extra) .'">Next</a>
            </li>';
            }

        $html .= '</ul>';

        return $html;
    }

    protected function query($page,array $extra = []){
        return '?page=' . $page . '&' . http_build_query($extra);
    }
}