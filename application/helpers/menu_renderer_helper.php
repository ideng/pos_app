<?php
defined('BASEPATH') or exit('No direct script access allowed!');

function render_individual_menu($menu_link = '', $menu_title = '', $menu_icon = '', $menu_nm = '') {
	$menu = '<li>';
		$menu .= '<a href="'.base_url($menu_link).'" title="'.$menu_title.'">';
			$menu .= '<i class="'.$menu_icon.'"></i> '.$menu_nm;
		$menu .= '</a>';
	$menu .= '</li>';
	return $menu;
}

function open_parent_menu($menu_title = '', $menu_icon = '', $menu_nm = '', $type = 'parent') {
	if ($type == 'parent') :
		$menu = '<li>';
			$menu .= '<a title="'.$menu_title.'"><i class="fa '.$menu_icon.'"></i> '.$menu_nm.' <span class="fa fa-chevron-down"></span></a>';
			$menu .= '<ul class="nav child_menu">';
	elseif ($type == 'child') :
		$menu = '<li>';
			$menu .= '<a title="'.$menu_title.'">'.$menu_nm.'<span class="fa fa-chevron-down"></span></a>';
			$menu .= '<ul class="nav child_menu">';
	endif;
	return $menu;
}

function close_parent_menu() {
	$menu = '</ul></li>';
	return $menu;
}

function render_child_menu($menu_link = '', $menu_title = '', $menu_nm = '') {
	$menu = '<li><a href="'.base_url($menu_link).'" title="'.$menu_title.'">'.$menu_nm.'</a></li>';
	return $menu;
}

function render_menu_form($menu = [], $form_name = '', $access = [], $attr = '') {
	$form = '<tr>';
		$form .= '<td>';
		if (!empty($attr)) {
			$form .= '<div class=\'' . $attr . '\'>';
			$form .= '<input type=\'hidden\' name=\'menu_id[]\' value=\'' . $menu->id . '\'>';
			$form .= $menu->title;
			$form .= '</div>';
		} else {
			$form .= '<input type=\'hidden\' name=\'menu_id[]\' value=\'' . $menu->id . '\'>';
			$form .= $menu->title;
		}
		$form .= '</td>';
		if (!$menu->is_global && $menu->link != '#') {
			$form .= '<td style="text-align: center;">';
				$form .= '<label for="id-chk-create-' . $menu->id . '">';
					$form .= '<input type="checkbox" name="chk_create'.$form_name.'" id="id-chk-create-' . $menu->id . '" class="chk-create icheck-blue" value="1" '.$access['create'].'>';
				$form .= '</label>';
			$form .= '</td>';
			$form .= '<td style="text-align: center;">';
				$form .= '<label for="id-chk-read-' . $menu->id . '">';
					$form .= '<input type="checkbox" name="chk_read'.$form_name.'" id="id-chk-read-' . $menu->id . '" class="chk-read icheck-blue" value="1" '.$access['read'].'>';
				$form .= '</label>';
			$form .= '</td>';
			$form .= '<td style="text-align: center;">';
				$form .= '<label for="id-chk-update-' . $menu->id . '">';
					$form .= '<input type="checkbox" name="chk_update'.$form_name.'" id="id-chk-update-' . $menu->id . '" class="chk-update icheck-blue" value="1" '.$access['update'].'>';
				$form .= '</label>';
			$form .= '</td>';
			$form .= '<td style="text-align: center;">';
				$form .= '<label for="id-chk-delete-' . $menu->id . '">';
					$form .= '<input type="checkbox" name="chk_delete'.$form_name.'" id="id-chk-delete-' . $menu->id . '" class="chk-delete icheck-blue" value="1" '.$access['delete'].'>';
				$form .= '</label>';
			$form .= '</td>';
		} elseif ($menu->is_global) {
			$form .= '<td colspan=\'4\'>';
				$form .= '<input type=\'hidden\' name=\'chk_create'.$form_name.'\' value=\'1\'>';
				$form .= '<input type=\'hidden\' name=\'chk_read'.$form_name.'\' value=\'1\'>';
				$form .= '<input type=\'hidden\' name=\'chk_update'.$form_name.'\' value=\'1\'>';
				$form .= '<input type=\'hidden\' name=\'chk_delete'.$form_name.'\' value=\'1\'>';
			$form .= '</td>';
		} else {
			$form .= '<td colspan=\'4\'></td>';
		}
	$form .= '</tr>';

	return $form;
}
