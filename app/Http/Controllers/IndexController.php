<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Kandidat;
use App\Models\Token;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function user()
    {
        return view('logintoken');
    }

    public function admin()
    {
        $events = Event::all();
        return view('adminall.admin', compact('events'));
    }

    public function superadm()
    {
        $events = Event::all();
        return view('adminall.index', compact('events'));
    }

    public function create()
    {
        return view('adminall.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required',
            'deskripsi' => 'required',
            'active' => 'required|boolean',
            'kuota_vote' => 'required|integer',
            'sembunyikan_foto' => 'required|boolean',
        ]);

        Event::create($request->all());

        return redirect('index/superadm')->with('success', 'Data event berhasil disimpan.');
    }

    public function edit($id_event)
    {
        $event = Event::findOrFail($id_event);
        return view('adminall.edit', ['id_event' => $id_event, 'event' => $event]);
    }

    public function update(Request $request, $id_event)
    {
        $event = Event::find($id_event);

        if (!$event) {
            return redirect()->back()->with('error', 'Event not found.');
        }

        $event->update($request->all());  
        return redirect()->to('index/superadm')->with('success', 'Berhasil Melakukan Update Data');
    }

    public function destroy($id_event)
    {
        try {
            DB::beginTransaction();
            $event = Event::find($id_event);

            if ($event) {
                Kandidat::where('id_event', $id_event)->delete();
                Token::where('id_event', $id_event)->delete();
                $event->delete();
                DB::commit();

                return response()->json(['success' => true]);
            } else {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Event not found']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }





    public function kandidat($id_event)
    {
        $event = Kandidat::where('id_event', $id_event)->get();
        $data = Kandidat::all();
        return view('adminall.kandidat', ['id_event' => $id_event, 'event' => $event, 'data' => $data]);
    }

    public function createkandidat($id_event)
    {
        $event = Kandidat::where('id_event', $id_event)->get();
        return view('adminall.tambahkandidat', ['id_event' => $id_event, 'event' => $event]);
    }

    public function storekandidat(Request $request)
    {
        $request->validate([
            'nama_kandidat' => 'required',
            'foto' => 'required',  
            'id_event' => 'required',
            'posisi' => 'required',
        ]);

        $id_event = $request->input('id_event');
        $kandidat = new Kandidat();
        $kandidat->nama_kandidat = $request->input('nama_kandidat');
        $kandidat->posisi = $request->input('posisi');
        $kandidat->id_event = $id_event;
        // Mengambil file foto dari request
        $foto = $request->file('foto');
        // Memeriksa apakah file foto ada
        if ($foto) {
        // Menyimpan file foto ke direktori yang diinginkan (storage/app/public/foto)
        $path = $foto->store('public/foto');

        // Mengambil nama file dari path
        $fileName = basename($path);

        // Menyimpan nama file foto ke dalam atribut 'foto' di model Kandidat
        $kandidat->foto = $fileName;
}

// Menyimpan data kandidat ke dalam database
$kandidat->save();

        return redirect('index/kandidat/' . $id_event)->with('success', 'Data event berhasil disimpan.');
    }

    public function editKandidat($id)
    {
        $kandidat = Kandidat::findOrFail($id);
        return view('adminall.editkandidat', ['id' => $id, 'kandidat' => $kandidat]);
    }

    public function updateKandidat(Request $request, $id)
    {
        $id_event = $request->input('id_event');
        $kandidat = Kandidat::find($id);

        if (!$kandidat) {
            return redirect()->back()->with('error', 'Kandidat not found.');
        }

        $kandidat->update($request->all());  
        return redirect()->to('index/kandidat/' . $id_event)->with('success','Berhasil Melakukan Update Data');
    }

    public function deleteKandidat($id)
    {
        $kandidat = Kandidat::find($id);

        if ($kandidat) {
            $kandidat->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }






    
    public function token($id_event)
    {
        $event = Token::where('id_event', $id_event)->get();
        $data = Token::all();
        return view('adminall.token',  ['id_event' => $id_event, 'event' => $event, 'data' => $data]);
    }

    public function createTokensForm($id_event)
    {  
        $event = Token::where('id_event', $id_event)->get();
        return view('adminall.tambahtoken', ['id_event' => $id_event, 'event' => $event]);
    }

    public function generateTokens(Request $request)
    {
        $quantity = $request->input('quantity');
        $id_event = $request->input('id_event');

        for ($i = 0; $i < $quantity; $i++) {
            $token = new Token();
            $token->token = Str::random(10);
            $token->quantity = $quantity;
            $token->id_event = $id_event;
            $token->save();
        }

        return redirect()->route('adminall.token', ['id_event' => $id_event])->with('success', 'Data event berhasil disimpan.');
    }

    public function useToken($token)
    {
        $votingToken = Token::where('token', $token)->first();

        if ($votingToken && !$votingToken->status) {
            $votingToken->status = true;
            $votingToken->save();
            return redirect()->back()->with('success', 'Token has been used successfully.');
        }

        return redirect()->back()->with('error', 'Token is invalid or has already been used.');
    }

    public function showCurrentDate()
    {
        $currentDate = Carbon::now()->format('M d, Y');
        return view('adminall.tambah', ['currentDate' => $currentDate]);
    }

    public function tambah()
{
    info('Metode tambah dipanggil.');
    return view('adminall.tambah');
}

    public function deleteToken($id)
    {
        $token = Token::find($id);

        if ($token) {
            $token->event()->dissociate();
            $token->save();
            $token->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }





    //RESULT HASIL
    public function result($id_event)
    {
        $event = Kandidat::where('id_event', $id_event)->get();
        $data = Kandidat::all();
        return view('adminall.result', ['id_event' => $id_event, 'event' => $event, 'data' => $data]);
    }
}
