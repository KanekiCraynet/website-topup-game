<?php

namespace App\Controllers;

class Search extends BaseController {

    public function index() {

        if ($this->request->getGet('s')) {

        	$search = addslashes(trim(htmlentities($this->request->getGet('s'))));

        	$games = $this->M_Base->data_like('games', 'name', $search);

	    	$data = array_merge($this->base_data, [
	    		'title' => 'Pencarian',
	    		'search' => $search,
	    		'games' => $games,
	    	]);

	        return view('Search/index', $data);
        } else {
        	return redirect()->to(base_url());
        }
    }
}