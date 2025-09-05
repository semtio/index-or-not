<?php
/*
Plugin Name: Index Or Not
Description: Индексируй только выбранные страницы, остальные получают noindex,nofollow.
Version: 1.0.0
Author: 7on
*/

// запрет прямого доступа
if ( ! defined( 'ABSPATH' ) ) { exit; }

function custom_control_robots_meta( $robots ) {
    // Сначала убираем возможные конфликты от темы/плагинов/ядра
    unset( $robots['index'], $robots['noindex'], $robots['follow'], $robots['nofollow'] );

    $temp_page = array( 'home-page' ); // замените на нужные ярлыки/ID

    if ( is_page( $temp_page ) ) {
        // Разрешённая страница
        $robots['index']  = true;
        $robots['follow'] = true; // можно и не указывать — по умолчанию "follow"
    } else {
        // Все остальные
        $robots['noindex'] = true;
		$robots['nofollow'] = true;
        // НЕ ставим nofollow, чтобы не резать краулинг ссылок
    }

    return $robots;
}

// высокий приоритет, чтобы перебить Yoast/RankMath/ядро
add_filter( 'wp_robots', 'custom_control_robots_meta', 999 );

