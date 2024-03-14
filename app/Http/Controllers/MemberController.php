<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.index', [
            'members' => Member::latest()->filter(request(['member']))->paginate(7)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:225',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $member = Member::latest()->first() ?? new Member();
        $kode_member = (int) $member->kode_member + 1;
        $validatedData['kode_member'] = tambah_nol_didepan($kode_member, 5);

        Member::create($validatedData);

        return redirect('/member')->with('success', 'Member baru berhasil di tambah!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $rules = [
            'nama' => 'required|max:225',
            'alamat' => 'required',
            'telepon' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Member::where('id_member', $member->id_member)
            ->update($validatedData);

        return redirect('/member')->with('success', 'Member berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        Member::destroy($member->id_member);

        return redirect('/member')->with('success', 'Member berhasil dihapus!');
    }
}
