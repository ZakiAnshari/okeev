<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\HomeTestimonial;
use Illuminate\Http\Request;

class HomeTestimonialController extends Controller
{
    /**
     * Display a listing of the testimonials.
     */
   

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean',
        ]);

        // Handle file upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('testimonials', $filename, 'public');
            $validated['profile_picture'] = 'storage/testimonials/' . $filename;
        }

        // Set status as boolean (checkbox value is '1' or null)
        $validated['status'] = $request->has('status') ? true : false;

        HomeTestimonial::create($validated);

        return redirect()->route('cms.home.content.index')->with('success', 'Testimonial berhasil ditambahkan')->with('open_testimonial_tab', true);
    }

    /**
     * Show the form for editing the specified testimonial.
     */
    public function edit($id)
    {
        $testimonial = HomeTestimonial::findOrFail($id);
        return view('admin.cms.home.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified testimonial in storage.
     */
    public function update(Request $request, $id)
    {
        $testimonial = HomeTestimonial::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|boolean',
        ]);

        // Handle file upload
        if ($request->hasFile('profile_picture')) {
            // Delete old file if exists
            if ($testimonial->profile_picture && file_exists(public_path($testimonial->profile_picture))) {
                unlink(public_path($testimonial->profile_picture));
            }

            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('testimonials', $filename, 'public');
            $validated['profile_picture'] = 'storage/testimonials/' . $filename;
        }

        // Set status as boolean
        $validated['status'] = $request->has('status') ? true : false;

        $testimonial->update($validated);

        return redirect()->route('cms.home.content.index')->with('success', 'Testimonial berhasil diperbarui')->with('open_testimonial_tab', true);
    }

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroy($id)
    {
        $testimonial = HomeTestimonial::findOrFail($id);

        // Delete file if exists
        if ($testimonial->profile_picture && file_exists(public_path($testimonial->profile_picture))) {
            unlink(public_path($testimonial->profile_picture));
        }

        $testimonial->delete();

        return redirect()->route('cms.home.content.index')->with('success', 'Testimonial berhasil dihapus')->with('open_testimonial_tab', true);
    }
}
