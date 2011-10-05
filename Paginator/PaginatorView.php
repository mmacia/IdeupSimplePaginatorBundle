<?php

namespace Ideup\SimplePaginatorBundle\Paginator;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Ideup\SimplePaginatorBundle\Paginator\Paginator as Paginator;

class PaginatorView
{
    protected $paginator;
    protected $templating;

    /**
     * Constructor
     * @param Paginator $paginator
     * @param EngineInterface $templating 
     */
    public function __construct(Paginator $paginator, EngineInterface $templating)
    {
        $this->paginator = $paginator;
        $this->templating = $templating;
    }
    
    /**
     *     
     * @param string $id
     * @param array $options
     * @param string $view
     */
    public function render($id, $route, $options = array(), $view = null)
    {
        $view = (!is_null($view)) ? $view : 'IdeupSimplePaginatorBundle:Paginator:paginator.html.twig';
        
        $defaultOptions  = array(            
            'paginatorId'       => $id,
            'route'             => $route,
            'previousPage'      => $this->paginator->previousPage($id),
            'previousText'      => 'previous',
            'showPrevious'      => ($this->paginator->currentPage($id) > 1) ? true : false,
            'hiddenPrevious'    => 'left_disabled'
        );
        
        return $this->templating->render($view, $options);
    }   
    
//    public function first($routeName, $title, $options, $paginatorId) {
//        $template = 'IdeupSimplePaginatorBundle:Paginator:first.html.twig';
//        $title = (is_null($title)) ? '<< First' : $title;
//        return trim($this->container->get('templating')->render($template, array(
//                    'paginator' => $this->paginator,
//                    'routeName' => (is_null($routeName)) ? '' : $routeName,
//                    'title' => $title,
//                    'tag' => (isset($options['tag'])) ? $options['tag'] : 'span',
//                    'paginatorId' => (is_null($paginatorId)) ? '' : $paginatorId,
//                    'disabledTitle' => (isset($options['disabledTitle'])) ? $options['disabledTitle'] : $title,
//                    'disabledClass' => (isset($options['disabledClass'])) ? $options['disabledClass'] : 'disabled'
//                )));
//    }
//
//    public function prev($routeName, $title, $options, $paginatorId) {
//        $template = 'IdeupSimplePaginatorBundle:Paginator:prev.html.twig';
//        $title = (is_null($title)) ? '< Prev' : $title;
//        return trim($this->container->get('templating')->render($template, array(
//                    'paginator' => $this->paginator,
//                    'routeName' => (is_null($routeName)) ? '' : $routeName,
//                    'title' => $title,
//                    'tag' => (isset($options['tag'])) ? $options['tag'] : 'span',
//                    'paginatorId' => (is_null($paginatorId)) ? '' : $paginatorId,
//                    'disabledTitle' => (isset($options['disabledTitle'])) ? $options['disabledTitle'] : $title,
//                    'disabledClass' => (isset($options['disabledClass'])) ? $options['disabledClass'] : 'disabled'
//                )));
//    }
//
//    public function numbers($routeName, $options, $paginatorId) {
//        $template = 'IdeupSimplePaginatorBundle:Paginator:numbers.html.twig';
//        return trim($this->container->get('templating')->render($template, array(
//                    'paginator' => $this->paginator,
//                    'routeName' => (is_null($routeName)) ? '' : $routeName,
//                    'tag' => (isset($options['tag'])) ? $options['tag'] : 'span',
//                    'paginatorId' => (is_null($paginatorId)) ? '' : $paginatorId,
//                    'currentClass' => (isset($options['currentClass'])) ? $options['currentClass'] : 'current',
//                    'modulus' => (isset($options['modulus'])) ? $options['modulus'] : 8,
//                    'first' => (isset($options['first'])) ? $options['first'] : 0,
//                    'last' => (isset($options['last'])) ? $options['last'] : 0,
//                    'separator' => (isset($options['separator'])) ? $options['separator'] : '|'
//                )));
//    }
//
//    public function next($routeName, $title, $options, $paginatorId) {
//        $template = 'IdeupSimplePaginatorBundle:Paginator:next.html.twig';
//        $title = (is_null($title)) ? 'Next >' : $title;
//        return trim($this->container->get('templating')->render($template, array(
//                    'paginator' => $this->paginator,
//                    'routeName' => (is_null($routeName)) ? '' : $routeName,
//                    'title' => $title,
//                    'tag' => (isset($options['tag'])) ? $options['tag'] : 'span',
//                    'paginatorId' => (is_null($paginatorId)) ? '' : $paginatorId,
//                    'disabledTitle' => (isset($options['disabledTitle'])) ? $options['disabledTitle'] : $title,
//                    'disabledClass' => (isset($options['disabledClass'])) ? $options['disabledClass'] : 'disabled'
//                )));
//    }
//
//    public function last($routeName, $title, $options, $paginatorId) {
//        $template = 'IdeupSimplePaginatorBundle:Paginator:last.html.twig';
//        $title = (is_null($title)) ? 'Last >>' : $title;
//        return trim($this->container->get('templating')->render($template, array(
//                    'paginator' => $this->paginator,
//                    'routeName' => (is_null($routeName)) ? '' : $routeName,
//                    'title' => $title,
//                    'tag' => (isset($options['tag'])) ? $options['tag'] : 'span',
//                    'paginatorId' => (is_null($paginatorId)) ? '' : $paginatorId,
//                    'disabledTitle' => (isset($options['disabledTitle'])) ? $options['disabledTitle'] : $title,
//                    'disabledClass' => (isset($options['disabledClass'])) ? $options['disabledClass'] : 'disabled'
//                )));
//    }
//
//    public function counter($format, $paginatorId) {
//        $paginatorId = (is_null($paginatorId)) ? '' : $paginatorId;
//        $format = (is_null($format)) ? 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%' : $format;
//        $fCounter = str_replace('%page%', $this->paginator->getCurrentPage($paginatorId), $format);
//        $fCounter = str_replace('%pages%', $this->paginator->getLastPage($paginatorId), $fCounter);
//        $fCounter = str_replace('%current%', $this->paginator->getItemsPerPage($paginatorId), $fCounter);
//        $fCounter = str_replace('%count%', $this->paginator->getTotalItems($paginatorId), $fCounter);
//        $fCounter = str_replace('%start%', $this->paginator->getOffset($paginatorId) + 1, $fCounter);
//        $end = $this->paginator->getOffset($paginatorId) + $this->paginator->getItemsPerPage($paginatorId);
//        $end = ($end < $this->paginator->getTotalItems($paginatorId)) ? $end : $this->paginator->getTotalItems($paginatorId);
//        $fCounter = str_replace('%end%', $end, $fCounter);
//        return trim($fCounter);
//    }
//
//    public function offset($index=0, $paginatorId, $startIndex) {
//        $paginatorId = (is_null($paginatorId)) ? '' : $paginatorId;
//        return $this->paginator->getOffset($paginatorId) + $index + $startIndex;
//    }
//
//    public function getName() {
//        return 'pagination_helper';
//    }

}
