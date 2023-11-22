@extends('index')

@section('content')
@if(Auth::user()->role == 'superadm' || Auth::user()->role == 'admin')
<div class="container">
    <div class="custom-buttons-container">
        <a href="{{ route('adminall.token', ['id_event' => $id_event]) }}" class="btn btn-custom-colors btn-sm">
            <i class="mdi mdi-coin"></i> Tambah Token
        </a>
        <a href="{{ route('adminall.tambahkandidat', ['id_event' => $id_event]) }}" class="btn btn-custom-color btn-sm">
            <i class="mdi mdi-plus-circle-outline"></i> Tambah Kandidat
        </a>
    </div>

    <br>
    <br>

    @if(count($data) > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kandidat</th>
                <th>Posisi</th>
                <th>Foto</th>
                <th>id event</th>
                <th class="text-center" style="margin: 0; padding: 0;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $kandidat)
            @if ($kandidat->id_event == $id_event)
            <tr class="table-info">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kandidat->nama_kandidat }}</td>
                <td>{{ $kandidat->posisi }}</td>
                <td>
                    @if($kandidat->foto)
                        <img src="{{ asset('storage/foto/' . $kandidat->foto) }}"  style="max-width: 100px;">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $kandidat->id_event }}</td>
                <td class="text-center" style="margin: 0; padding: 0;">
                    <a href="{{ route('adminall.editkandidat', ['id' => $kandidat->id]) }}" class="btn btn-custom-color btn-xs mx-0.5">
                        <i class="mdi mdi-table-edit"></i> Edit
                    </a>
                    <a href="#" onclick="showDeleteConfirmation({{ $kandidat->id }})" class="btn btn-danger btn-xs mx-0.5">
                        <i class="mdi mdi-delete delete-icon"></i> Delete
                    </a>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>

    <!-- Modal untuk Konfirmasi Penghapusan -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this candidate?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="deleteKandidat()">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideDeleteConfirmation()">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteConfirmation(id) {
            var modal = $('#deleteConfirmationModal');
            modal.modal('show');
            modal.data('kandidat-id', id);
        }

        function hideDeleteConfirmation() {
            $('#deleteConfirmationModal').modal('hide');
        }

        function deleteKandidat() {
            var id = $('#deleteConfirmationModal').data('kandidat-id');
            var deleteUrl = "{{ url('/deleteKandidat') }}/" + id;

            fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Candidate deleted successfully.');
                        location.reload();
                    } else {
                        alert('Failed to delete candidate.');
                    }
                    hideDeleteConfirmation();
                })
                .catch(error => {
                    console.error('Error:', error);
                    hideDeleteConfirmation();
                });
        }
    </script>

    @else
    <p>No data available</p>
    @endif
</div>
@endsection
