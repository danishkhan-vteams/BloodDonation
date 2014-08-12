<?php

class CustomGridView extends CWidget
{
    public $dataProvider = NULL;
    public $columns = array();
    public $gridActions = '';
    public $filter = NULL;
    public $enableSorting = TRUE;
    public $filterPosition = 'body';
    public $updateUrl = null;
    public $viewUrl = null;
    public $enablePagination = 'true';
    public $params = array();
    public $pager = array(
        'header'=>'',
        'cssFile'=>FALSE,
        'firstPageLabel'=>'first',
        'lastPageLabel'=>'last',
        'nextPageLabel'=>'next',
        'prevPageLabel'=>'previous',
    );
    
    public $summaryText = 'Viewing {start}-{end} of {count}';
    
    public $template = '<div class="grid-view-utils clearfix">{summary}{pager}</div>{items}<div class="grid-view-utils clearfix">{summary}{pager}</div>';
    
    public $id = '#custom-grid';
    
    public $sep = '';//'&nbsp;|&nbsp;';
    
    public function init()
    { 
        $colsT  = sizeof($this->columns);
        switch($this->gridActions)
        {
            case 'none':
                
				break;
            case 'ud' :
                $this->columns[$colsT] = array(
                    'class'=>'CButtonColumn',
                    'template'=>'{update}'.$this->sep.'{delete}',
                    'header'=>'actions',
                );
                break;
            
            case 'vd' :
                $this->columns[$colsT] = array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}'.$this->sep.'{delete}',
                    'header'=>'actions',
                );
                break;
                
            default :
                $this->columns[$colsT] = array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}'.$this->sep.'{update}'.$this->sep.'{delete}',
                    'header'=>'actions',
                );
                break;
        }
        if(!empty($this->gridActions) )
        {
            $buttons = array();
           
            if(!empty($this->updateUrl))
            {   $updateUrl = $this->updateUrl;     
                $buttons['update'] =  
                                array(
                                     'url'=>'$this->grid->controller->createUrl("'.$updateUrl.'", array("id"=>$data->id))',
                                    );
            }
            
            if(!empty($this->viewUrl))
            {   
				$viewUrl = $this->viewUrl;   
				//setting up the parameters...			
				
				$params ['id'] = '$data->id';
				if(!empty($this->params))  
					$params = array_merge($params,$this->params);
				$paramTxt = array();	
				foreach((array) $params as $k=>$v)
				{
					$paramTxt[] = "\"$k\"=>\"$v\"";
				}
				$paramTxt = "array(".implode($paramTxt,',').")";
				
               $buttons['view'] =
                                array(
                                                    'url'=>'$this->grid->controller->createUrl("'.$viewUrl.'", '.$paramTxt.')',
                                );
            }
			if(!empty($buttons))
            $this->columns[$colsT]['buttons'] = $buttons;
        }
    }
    
    public function run()
    {
        $this->widget(
            'zii.widgets.grid.CGridView',
            array(
                'id' => $this->id,
                //'cssFile' => FALSE,
                'dataProvider' => $this->dataProvider,
                'filter'=>$this->filter,
                'summaryText' => $this->summaryText,
                'pager' => $this->pager,
                'template' => $this->template,
                'columns' => $this->columns,
                'enableSorting' => $this->enableSorting,
                'enablePagination' => $this->enablePagination,
                'filterPosition' => $this->filterPosition,
            )
        );
    }
}
?>
