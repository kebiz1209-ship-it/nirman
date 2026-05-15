<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data          = [];
        $data['title'] = __('index.outlets');
        $data['obj']   = Outlet::where('del_status', 'Live')
            ->where('company_id', Auth::user()->company_id)
            ->orderBy('id', 'desc')
            ->get();
        return view('pages.outlet.outlets', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data          = [];
        $data['title'] = __('index.add_outlet');
        return view('pages.outlet.addEditOutlet', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'outlet_name'    => 'required|string|max:255',
            'outlet_address' => 'required|string|max:500',
            'outlet_phone'   => 'required|string|max:20',
            'outlet_email'   => 'nullable|email|max:255',
            'outlet_status'  => 'required|in:active,inactive',
        ]);

        $outlet                 = new Outlet();
        $outlet->outlet_code    = Outlet::generateOutletCode();
        $outlet->outlet_name    = $request->outlet_name;
        $outlet->outlet_address = $request->outlet_address;
        $outlet->outlet_phone   = $request->outlet_phone;
        $outlet->outlet_email   = $request->outlet_email;
        $outlet->outlet_status  = $request->outlet_status;
        $outlet->company_id     = Auth::user()->company_id;
        $outlet->save();

        return redirect()->route('outlets.index')->with('success', __('index.outlet_added_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function show(Outlet $outlet)
    {
        $data          = [];
        $data['title'] = __('index.outlet_details');
        $data['obj']   = $outlet;
        return view('pages.outlet.outletDetails', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id     = encrypt_decrypt($id, 'decrypt');
        $outlet = Outlet::findOrFail($id);

        $data          = [];
        $data['title'] = __('index.edit_outlet');
        $data['obj']   = $outlet;
        return view('pages.outlet.addEditOutlet', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id     = encrypt_decrypt($id, 'decrypt');
        $outlet = Outlet::findOrFail($id);

        $request->validate([
            'outlet_name'    => 'required|string|max:255',
            'outlet_address' => 'required|string|max:500',
            'outlet_phone'   => 'required|string|max:20',
            'outlet_email'   => 'nullable|email|max:255',
            'outlet_status'  => 'required|in:active,inactive',
        ]);

        $outlet->outlet_name    = $request->outlet_name;
        $outlet->outlet_address = $request->outlet_address;
        $outlet->outlet_phone   = $request->outlet_phone;
        $outlet->outlet_email   = $request->outlet_email;
        $outlet->outlet_status  = $request->outlet_status;
        $outlet->save();

        return redirect()->route('outlets.index')->with('success', __('index.outlet_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outlet             = Outlet::findOrFail($id);
        $outlet->del_status = 'Deleted';
        $outlet->save();

        return redirect()->route('outlets.index')->with('success', __('index.outlet_deleted_successfully'));
    }

    public function select($id)
    {
        $id     = encrypt_decrypt($id, 'decrypt');
        $outlet = Outlet::findOrFail($id);
        session(['outlet_id' => $outlet->id]);
        return redirect()->route('dashboard')->with('success', __('index.outlet_selected_successfully'));
    }
}
