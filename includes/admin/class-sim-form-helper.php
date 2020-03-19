<?php

  namespace simForm;

/**
 * Sim_Form_Helper
 *
 * form helper class
 */
final class Sim_Form_Helper
{

  /**
   * Input Field
   *
   * @param  string  $name     the name of the field
   * @param  boolean $required set if this field is a required field
   * @param  string  $type     the field type
   * @return
   */
  public function input($name='name',$required=false,$type='text'){
    $name = strtolower($name);
    // set reuired
    if ($required) {
      // code...
      $require = ' <span class="description">(required)</span>';
    } else {
      $require = '';
    }
    // lets build out the input
    $input  = '<!-- '.$name.'_input -->';
    $input .= '<tr class="input">';
    $input .= '<th>';
    $input .= '<label for="'.str_replace(" ", "_", $name).'">';
    $input .= ucwords(str_replace("_", " ", $name));
    $input .= $require;
    $input .= '</label>';
    $input .= '</th>';
    $input .= '<td>';
    $input .= '<input type="'.$type.'" name="'.str_replace(" ", "_", $name).'" id="'.str_replace(" ", "_", $name).'" aria-describedby="'.str_replace(" ", "-", $name).'-description" value="" class="uk-input">';
    $input .= '<p class="description" id="'.str_replace(" ", "-", $name).'-description">';
    $input .= 'Enter '.strtolower(str_replace("_", " ", $name));
    $input .= '<strong>.</strong>';
    $input .= '</p>';
    $input .= '</td>';
    $input .= '</tr>';
    $input .= '<!-- '.$name.'_input -->';
    return $input;
  }

  /**
   * Textarea
   *
   * @param  string  $name     field name
   * @param  boolean $required set the filed to required
   * @return
   */
  public function textarea($name='name',$required=false){
    $name = strtolower($name);
    // set reuired
    if ($required) {
      $require = ' <span class="description">(required)</span>';
    } else {
      $require = '';
    }
    // lets build out the textarea
    $textarea  = '<!-- '.$name.'_textarea -->';
    $textarea .= '<tr class="textarea">';
    $textarea .= '<th>';
    $textarea .= '<label for="'.str_replace(" ", "_", $name).'">';
    $textarea .= ucwords(str_replace("_", " ", $name));
    $textarea .= $require;
    $textarea .= '</label>';
    $textarea .= '</th>';
    $textarea .= '<td>';
    $textarea .= '<textarea class="uk-textarea" name="'.str_replace(" ", "_", $name).'_textarea" rows="8" cols="50">';
    $textarea .= '</textarea>';
    $textarea .= '<p class="description" id="'.str_replace(" ", "-", $name).'-description">';
    $textarea .= 'Enter '.strtolower(str_replace("_", " ", $name));
    $textarea .= '<strong>.</strong>';
    $textarea .= '</p>';
    $textarea .= '</td>';
    $textarea .= '</tr>';
    $textarea .= '<!-- '.$name.'_textarea -->';
    return $textarea;
  }

  /**
   * Custom version of the WP Dropdown Category list
   *
   * @param  string $name   field name
   * @param  array $args define custom arguments
   * @return
   * @link https://developer.wordpress.org/reference/functions/wp_dropdown_categories/
   */
  public function categorylist($name=null,$args = array()){
    $catlist_args = array(
      'show_option_all'    => '',
      'show_option_none'   => '',
      'option_none_value'  => '-1',
      'orderby'            => 'ID',
      'order'              => 'ASC',
      'show_count'         => 0,
      'hide_empty'         => 1,
      'child_of'           => 0,
      'exclude'            => '',
      'echo'               => 0,
      'selected'           => 0,
      'hierarchical'       => 0,
      'name'               => strtolower(str_replace(" ", "_", $name)).'set_category',
      'id'                 => '',
      'class'              => 'uk-select',
      'depth'              => 0,
      'tab_index'          => 0,
      'taxonomy'           => 'category',
      'hide_if_empty'      => false,
      'value_field'	     => 'term_id',
    );
    // ref https://developer.wordpress.org/reference/functions/wp_dropdown_categories/
    $categories = '<tr class="input-select">';
    $categories .= '<th><label for="select_dropdown">Select a Category</label></th>';
    $categories .= '<td>';
    $categories .= wp_dropdown_categories($catlist_args);
    $categories .= '</td>';
    $categories .= '</tr>';
    return $categories;
  }

  /**
   * Make Table
   *
   * Use this to create a table for the form
   * @param  string $tag decide to open or close table
   * @param  string $tbclass ad css class
   * @return
   */
  public function table($tag='close', $tbclass=''){
    if ($tag === 'open') {
      // lets open tags for the table
      $table  = '<table class="form-table '.$tbclass.'" role="presentation">';
      $table .= '<tbody>';
    } elseif ($tag === 'close') {
      // lets close the tags for the table
      $table  = '</tbody>';
      $table .= '</table>';
    }
    return $table;
  }

  /**
   * input_val
   *
   * Get the input field $_POST data
   * @param  string $input_field input name
   * @return string
   */
  public function input_val($input_field=null){
    $input = $_POST[$input_field];
    if ( isset( $_POST[$input_field] )) {
      return $input;
    }
  }

  /**
   * nonce field
   *
   * @param  string $name nonce field name
   * @return
   * @link https://developer.wordpress.org/reference/functions/wp_nonce_field/
   */
  public function nonce($wpnonce = '_swa_page_wpnonce'){
    return wp_nonce_field( -1, $wpnonce, true , true);
  }

  /**
   * nonce_check
   *
   * @param  string $noncefield [description]
   * @return
   * @link https://developer.wordpress.org/reference/functions/wp_verify_nonce/
   */
  public function verify_nonce($noncefield='_swa_page_wpnonce'){
    /**
     * Lets verify the @return boolean
     */
    if ( ! isset( $_POST[$noncefield] ) || ! wp_verify_nonce( $_POST[$noncefield] )) {
      return false;
    } else {
      return true; // nonce is invalid
    }
  }

}
