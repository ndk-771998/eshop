<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingAddRequest;
use App\Models\Setting;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;

class SettingAdminController extends Controller
{
    use DeleteModelTrait;

    protected $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        $settings = $this->setting->latest()->paginate(10);

        return view('admin.setting.index', compact('settings'));
    }

    public function create()
    {

        return view('admin.setting.create');
    }

    public function store(SettingAddRequest $request)
    {
        $this->setting->create([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
            'type' => $request->type
        ]);

        return redirect()->route('setting.index');
    }

    public function edit($id)
    {
        $setting = $this->setting->findOrFail($id);

        return view('admin.setting.edit', compact('setting'));
    }

    public function delete($id){
        return $this->deleteModelTrait($id, $this->setting);
    }

    public function update(Request $request, $id)
    {
        $dataSettingUpdate = [
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
        ];

        $this->setting->find($id)->update($dataSettingUpdate);

        return redirect()->route('setting.index');
    }
}
