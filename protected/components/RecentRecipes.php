<?php

Yii::import('zii.widgets.CPortlet');
Yii::import('zii.widgets.grid.CGridView');
 
class RecentRecipes extends CPortlet
{
    public $title='Senaste recept';
    public $maxRecipes=5;
    public $contentCssClass='recent-recipes portlet-content';
 
    public function init()
    {
      $uri = '/test/css/portlets.css';
      Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');
      return parent::init();
    }
    protected function renderContent()
    {
        $criteria = array(
            'order'=>'id DESC',
            'select'=>'id,title',
            'limit'=>$this->maxRecipes,
        );

        $recipes = Recipe::model()->findAll($criteria);
        
        echo '<ul>';
        foreach ($recipes as $recipe)
        {
            echo '<li>' . CHtml::link($recipe->title, array('recipe/view', 'recipeID'=>$recipe->id)) . '</li>';
        }
        echo '</ul>';
    }
}
