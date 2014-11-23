<?php namespace app;

class BBCodeExtension extends \Twig_Extension
{
    private $search  = array('[b]', '[/b]', '[i]', '[/i]', '[u]', '[/u]', '[s]', '[/s]', '[code]', '[/code]', '[quote]', '[/quote]', '[/url]' );
    private $replace = array('<b>', '</b>', '<em>', '</em>', '<u>', '</u>', '<del>', '</del>', '<pre>', '</pre>', '<blockquote>', '</blockquote>', '</a>' );

    private $searchRegex  = array('/(\[url=)([^\]]+)(\])/', '/(\[url\])([^\]]+)(\])/', '/(\[img\])([^\[\/img\]]+)(\[\/img\])/', '/(\[video\])([a-zA-Z0-9_-]+)(\[\/video\])/' );
    private $replaceRegex = array('<a href="\2">', '<a href="\2">\2', '<img src="\2" alt="" />', '<iframe width="420" height="315" src="//www.youtube.com/embed/\2" frameborder="0" allowfullscreen></iframe>' );

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('bbCode', array($this, 'bbCodeFilter'), array('is_safe' => array('html')) ),
        );
    }

    /**
     * Converts BBCode tag into HTML tags
     *
     * @param $string String source
     *
     * @return string
     */
    public function bbCodeFilter($string)
    {
        return preg_replace($this->searchRegex, $this->replaceRegex,
                    str_replace($this->search, $this->replace, $string)
                );
    }

    public function getName()
    {
        return 'bbcode_extension';
    }
}
