<?php
foreach ($sections as $section) {
	foreach ($section['items'] as $item) {
		$data = [
			'sort' => preg_replace('/[^\w]/', '', $item['text']),
			'from' => $item['from'],
			'type' => $slug
		];

		if (!empty($item['deprecated'])) {
			$data['deprecated'] = $item['deprecated'];
		}

		if (!empty($item['removed'])) {
			$data['removed'] = $item['removed'];
		}

		$d = htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');

		echo '<option data-data="'.$d.'" value="'.$item['doc'].'">'.$item['text'].'</option>';
	}
}
