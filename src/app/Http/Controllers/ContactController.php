<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    
    public function index()
    {
        return view('contact');
    }

    
    public function confirm(Request $request)
    {
        $inputs = $request->all();
        return view('confirm', compact('inputs'));
    }

    
    public function send(Request $request)
    {
       
        if ($request->input('action') === 'back') {
            
            return redirect()->route('contact.index')->withInput();
        }

        
        Contact::create([
            'name'        => $request->name,
            'gender'      => $request->gender,
            'email'       => $request->email,
            'detail_type' => $request->detail_type,
            'content'     => $request->content,
        ]);


        
        return redirect()->route('contact.thanks');
    }

    
    public function thanks()
    {
        return view('thanks');
    }



    public function admin(Request $request)
{
    $query = Contact::query();

     
        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }

        
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        
        if ($request->filled('detail_type') && $request->detail_type !== 'all') {
            $query->where('detail_type', $request->detail_type);
        }

        
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        
        $contacts = $query->paginate(7);

        
        return view('admin', compact('contacts'));
    }
    
    public function destroy($id)
    {
        
        $contact = Contact::findOrFail($id);
        $contact->delete();

        
        return redirect()->route('contact.admin')->with('success', 'お問い合わせデータを削除しました。');
    } 


 }


