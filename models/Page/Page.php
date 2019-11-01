<?php


class Page
{
    const HEAD = ROOT.'/views/inc/head.html.php';

    protected $title;

    const BREADCRUMBS = ROOT.'/views/inc/breadcrumbs.html.php';

    const FOOTER = ROOT.'/views/inc/footer.html.php';

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }
}