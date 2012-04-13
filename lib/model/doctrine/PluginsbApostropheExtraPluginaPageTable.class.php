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
    return Doctrine::getTable('aCategory')->createQuery('c')
            ->innerJoin('c.ProjectPages AS p')
            ->orderBy('c.name')
            ->groupBy('c.id')
            ->execute();
  }
}