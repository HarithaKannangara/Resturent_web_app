<?php

namespace App\Http\Controllers;

use App\Models\Concession;
use Illuminate\Http\Request;

class ConcessionController extends Controller
{
    public function index()
    {
        $concessions = Concession::all();
        return view('concessions.index', compact('concessions'));
    }

    public function create()
    {
        return view('concessions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload'), $imageName);
            $imagePath = 'upload/' . $imageName;
        }

        Concession::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_path' => $imagePath,
            'price' => $request->price,
        ]);

        return redirect()->route('concessions.index')->with('success', 'Concession added successfully!');
    }

    public function edit(Concession $concession)
    {
        return view('concessions.edit', compact('concession'));
    }

    public function update(Request $request, Concession $concession)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($concession->image_path && file_exists(public_path($concession->image_path))) {
                unlink(public_path($concession->image_path));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload'), $imageName);
            $concession->image_path = 'upload/' . $imageName;
        }

        $concession->update([
            'name' => $request->name,
            'description' => $request->description,
            'image_path' => $concession->image_path,
            'price' => $request->price,
        ]);

        return redirect()->route('concessions.index')->with('success', 'Concession updated successfully!');
    }

    public function destroy(Concession $concession)
    {
        // Delete the image file if it exists
        if ($concession->image_path && file_exists(public_path($concession->image_path))) {
            unlink(public_path($concession->image_path));
        }

        $concession->delete();

        return redirect()->route('concessions.index')->with('success', 'Concession deleted successfully!');
    }
}
