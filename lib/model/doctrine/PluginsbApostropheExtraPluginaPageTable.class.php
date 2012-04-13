<?php

/**
 * Description of PluginsbApostropheExtraPluginaPageTable
 *
 * @author Giles Smith <tech@superrb.com>
 */
class PluginsbApostropheExtraPluginaPageTable extends PluginaPageTable
{
  public static function listProjectPageCategories()
  {
    $fast = sfConfig::get('app_a_fasthydrate', false);
    return Doctrine::getTable('aCategory')->createQuery('c')
            ->innerJoin('c.ProjectPages AS p')
            ->orderBy('c.name')
            ->groupBy('c.id')
            ->execute(array(), $fast ? Doctrine::HYDRATE_ARRAY : Doctrine::HYDRATE_RECORD);
  }
}