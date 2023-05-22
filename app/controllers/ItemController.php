<?php

class ItemController extends BaseController {
    public function showItemSearch() {
        view('items');
    }

    public function search() {
        $data = Request::all();

        $response = (new ItemSearchService())
            ->appendSearchRequest($data)
            ->getSearchResults();

        return $response['results'];
    }

    public function showItem() {
        $id = Request::get('object_id');

        $item = (new ItemSearchService())
            ->getItem($id);
        // var_dump($item);die;
        view('item', compact('item'));
    }
}