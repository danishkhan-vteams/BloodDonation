<div id="contact_elm_<?=$k?>" class="contact_box">
        <table cellpadding="0" cellspacing="0" border="1">
            <tr>
            	<td width=50>
                <?php echo CHtml::activeDropDownList($donarContact,"[$k]contact_type",$donarContact->getContactType(),
				array('onchange'=>"if(this.value=='Phone') $('#".CHtml::getActiveId($donarContact,"[$k]ext")."').fadeIn(); else $('#".CHtml::getActiveId($donarContact,"[$k]ext")."').fadeOut();"));?>
                </td>
                <td width="55">
		                <?php echo CHtml::activeHiddenField($donarContact,"[$k]id");?>
                		<?php echo CHtml::activeTextField($donarContact,"[$k]contact_number",array('size'=>60));?>
                    	<?php echo CHtml::error($donarContact, 'contact_number');?>
                </td>
                <td width="50"><?php echo CHtml::activeTextField($donarContact,"[$k]ext", array('style'=>"width:40px;". ($donarContact->contact_type!='Phone'? 'display:none' : "")));?></td>
                <td width="">
                        <?php 
                            if($donarContact->id > 0){
                                echo CHtml::ajaxButton(
                                        "X",
                                        $this->createUrl('deleteContact', array('id'=>$donarContact->id)),
                                        array(
                                            'dataType'=>'json',
                                            'success'=>"function(data){
                                                //alert(data);
                                                if(data.status=='ok'){
                                                    $('#contact_elm_".$k."').remove();
                                                }else{
                                                    alert(data.msg);
                                                }
                                        }
                                        "),
                                        array('confirm'=>'Are you sure, want to delete this box')
                                        );
                            }else{
                                if($k>0){
                                    echo CHtml::button("X",array(
                                                'onclick'=>"
                                                    if(confirm('Are you sure, want to delete this box')){
                                                        $('#contact_elm_".$k."').remove();
                                                    }
                                                "
                                            ));
                                }
                            }
                          ?>
                </td>
      </tr>
  </table>
</div>