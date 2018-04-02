<?php
/**
 * Created by IntelliJ IDEA.
 * User: yux
 * Date: 31/03/18
 * Time: 15.41
 */

namespace cms\model;


use cms\doctrine\model\Menu;
use cms\doctrine\model\MenuItem;
use Doctrine\Common\Collections\ArrayCollection;

class MenuFactory
{

    public static function createMenu(array $params):Menu{
        $menu = new Menu();
        $menu->setAlias(filter_var($params['alias'], FILTER_SANITIZE_STRING));
        $menu->setStatus((int) filter_var($params['status'], FILTER_SANITIZE_NUMBER_INT));
        $menu->setTitle(filter_var($params['title'], FILTER_SANITIZE_STRING));
        if ($params['items']){
            $items = new ArrayCollection();
            foreach ($params['items'] as $item){
                $items->add(self::createMenuItem($item));
            }
            $menu->setItems($items);
        }
        return $menu;
    }

    public static function updateMenu(Menu $menu, array $params){
      $menu->setAlias(filter_var($params['alias'], FILTER_SANITIZE_STRING));
      $menu->setStatus((int) filter_var($params['status'], FILTER_SANITIZE_NUMBER_INT));
      $menu->setTitle(filter_var($params['title'], FILTER_SANITIZE_STRING));

      foreach ($menu->getItems() as $item) {
          foreach ($params['items'] as $unserilizedItem) {
              if ($item->getId() === $unserilizedItem['id']){
                  self::updateMenuItem($item,  $unserilizedItem);
              }
          }

      }
    }

    public static function updateMenuItem(MenuItem $menuItem, array  $params) {
        $menuItem->setAlias(filter_var($params['alias'], FILTER_SANITIZE_STRING));
        $menuItem->setTitle(filter_var($params['title'], FILTER_SANITIZE_STRING));
        $menuItem->setStatus((int) filter_var($params['status'], FILTER_SANITIZE_NUMBER_INT));
        $menuItem->setAction(filter_var($params['action'], FILTER_SANITIZE_STRING));
        $menuItem->setParameters($params['parameters']);
    }

    private static function createMenuItem(array $params):MenuItem
    {
        $menuItem = new MenuItem();
        $menuItem->setAlias(filter_var($params['alias'], FILTER_SANITIZE_STRING));
        $menuItem->setTitle(filter_var($params['title'], FILTER_SANITIZE_STRING));
        $menuItem->setStatus((int) filter_var($params['status'], FILTER_SANITIZE_NUMBER_INT));
        return $menuItem;
    }

}