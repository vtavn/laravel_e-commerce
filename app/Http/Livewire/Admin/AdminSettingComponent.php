<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;
use App\Models\Category;

class AdminSettingComponent extends Component
{
    public $email, $phone, $phone_2, $address, $map, $twiter, $facebook, $telegram, $instagram, $youtube, $category_home,$banner_home, $banner_home_2, $banner_home_product_new, $banner_home_category_new, $banner_shop, $banner_home_category;

    public function mount()
    {
        $setting = Setting::find(1);
        if ($setting) {
            $this->email = $setting->email;
            $this->phone = $setting->phone;
            $this->phone_2 = $setting->phone_2;
            $this->address = $setting->address;
            $this->map = $setting->map;
            $this->twiter = $setting->twiter;
            $this->facebook = $setting->facebook;
            $this->telegram = $setting->telegram;
            $this->instagram = $setting->instagram;
            $this->youtube = $setting->youtube;
            $this->category_home = explode(',', $setting->header_category);
            $this->banner_home = $setting->banner_home;
            $this->banner_home_2 = $setting->banner_home_2;
            $this->banner_home_product_new = $setting->banner_home_product_new;
            $this->banner_home_category_new = $setting->banner_home_category_new;
            $this->banner_shop = $setting->banner_shop;
            $this->banner_home_category = $setting->banner_home_category;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly(
            $fields,
            [
                'email' => 'required|email',
                'phone' => 'required',
                'phone_2' => 'required',
                'address' => 'required',
                'map' => 'required',
                'twiter' => 'required',
                'facebook' => 'required',
                'telegram' => 'required',
                'instagram' => 'required',
                'youtube' => 'required'
            ]
        );
    }

    public function saveSettings()
    {
        $this->validate([
            'email' => 'required|email',
            'phone' => 'required',
            'phone_2' => 'required',
            'address' => 'required',
            'map' => 'required',
            'twiter' => 'required',
            'facebook' => 'required',
            'telegram' => 'required',
            'instagram' => 'required',
            'youtube' => 'required'
        ]);
        $setting = Setting::find(1);
        if (!$setting) {
            $setting = new Setting();
        }
        $setting->email = $this->email;
        $setting->phone = $this->phone;
        $setting->phone_2 = $this->phone_2;
        $setting->address = $this->address;
        $setting->map = $this->map;
        $setting->twiter = $this->twiter;
        $setting->facebook = $this->facebook;
        $setting->telegram = $this->telegram;
        $setting->instagram = $this->instagram;
        $setting->youtube = $this->youtube;
        $setting->banner_home = $this->banner_home;
        $setting->banner_home_2 = $this->banner_home_2;
        $setting->banner_home_product_new = $this->banner_home_product_new;
        $setting->banner_home_category_new = $this->banner_home_category_new;
        $setting->banner_shop = $this->banner_shop;
        $setting->banner_home_category = $this->banner_home_category;
        $setting->header_category = implode(',', $this->category_home);
        $setting->save();
        
        return redirect()->route('admin.settings')->with('message', 'Setting has been saved successfully.');

    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-setting-component', compact('categories'))->layout('layouts.admin');
    }
}
