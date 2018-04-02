<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 31/03/18
 * Time: 20.53
 */

namespace cms\library\crud;


interface LinkableEntity
{

    public function getAction();
    public function getParameters();
    public function getLink();
    public function setLink(string $link);

}