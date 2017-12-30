<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 29/12/17
 * Time: 12.03
 */

namespace cms\library\module;


interface ModuleInterface
{

    public function install():bool;
    public function uninstall():bool;

}