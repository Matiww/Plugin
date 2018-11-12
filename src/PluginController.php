<?php

namespace Matiww\Plugin;

use App\Http\Controllers\Controller;
use DemeterChain\A;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PluginController extends Controller
{

    const ALL_PRODUCTS = 0;
    const AVAILABLE_PRODUCTS = 1;
    const NOT_AVAILABLE_PRODUCTS = 2;
    const PRODUCTS_MORE_THAN_5 = 3;

    private $client;

    public function __construct() {
        if(!$this->client) {
            $this->client = new \GuzzleHttp\Client();
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index(Request $request)
    {
        $response = $this->client->request('POST', config('plugin.items_db').'/filtered', [
            'form_params' => [
                'filter' => $request->filter,
            ]
        ]);

        $data = json_decode($response->getBody());

        return view('view::items', [
            'items' => $data->items,
            'filter' => $data->filter
        ]);

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('view::add-edit-item');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|integer'
        ]);

        $response = $this->client->request('POST', config('plugin.items_db'), [
            'form_params' => [
                'name' => $request->name,
                'amount' => $request->amount,
            ]
        ]);

        return redirect('items');
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function edit($id)
    {
        $response = $this->client->request('GET', config('plugin.items_db').'/'.$id.'/edit');

        $data = json_decode($response->getBody());

        return view('view::add-edit-item', [
            'item' => $data->item
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|integer'
        ]);

        $response = $this->client->request('PUT', config('plugin.items_db').'/'.$id, [
            'form_params' => [
                'name' => $request->name,
                'amount' => $request->amount,
            ]
        ]);

        return redirect('items');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function destroy($id)
    {
        $response = $this->client->request('DELETE', config('plugin.items_db').'/'.$id);

        return redirect('items');
    }
}
