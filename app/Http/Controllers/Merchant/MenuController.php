<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Tampilkan semua menu merchant, dengan search & filter jenis
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');

        $menus = Menu::where('merchant_id', auth()->id())
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->when($type, fn($q) => $q->where('type', $type))
            ->get();

        return view('merchant.menus.index', compact('menus'));
    }

    /**
     * Tampilkan form create menu
     */
    public function create()
    {
        return view('merchant.menus.create');
    }

    /**
     * Simpan menu baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'type' => 'required|string|max:50', 
            'photo' => 'nullable|image|max:2048', 
        ]);

        $photoPath = $request->hasFile('photo')
            ? $request->file('photo')->store('menus', 'public')
            : null;

        Menu::create([
            'merchant_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'price' => $request->price,
            'photo' => $photoPath,
        ]);

        return redirect()->route('merchant.menus.index')
            ->with('success', 'Menu berhasil ditambahkan');
    }

    /**
     * Tampilkan form edit menu
     */
    public function edit(Menu $menu)
    {
        if ($menu->merchant_id !== auth()->id()) {
            abort(403);
        }

        return view('merchant.menus.edit', compact('menu'));
    }

    /**
     * Update menu
     */
    public function update(Request $request, Menu $menu)
    {
        if ($menu->merchant_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'type' => 'required|string|max:50', 
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name', 'description', 'price', 'type');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('merchant.menus.index')
            ->with('success', 'Menu berhasil diupdate');
    }

    /**
     * Hapus menu
     */
    public function destroy(Menu $menu)
    {
        if ($menu->merchant_id !== auth()->id()) {
            abort(403);
        }

        $menu->delete();

        return redirect()->route('merchant.menus.index')
            ->with('success', 'Menu berhasil dihapus');
    }
}