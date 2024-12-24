@extends('layouts.app')
@section('contenus')
    <div class="container">
        <div class="page-inner">
            <div class="row justify-content-center mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-start">
                                <h4><strong>Information sur les enregistrements</strong></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <h4><strong>Information sur les enregistrements  des zones de provenance</strong></h4>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Circuits inter-Etats</th>
                                                <th scope="col">Circuits internes</th>
                                                <th scope="col">Excursions</th>
                                                <th scope="col">Date</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @forelse ($zone as $zone)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $zone->cur_etat_resi_nat_m1 }}</td>
                                                <td>{{ $zone->cur_etat_resi_nat_m2 }}</td>
                                                <td>{{ $zone->cur_etat_resi_nat_m3 }}</td>
                                                <td>{{ $zone->cur_etat_nonresi_bf_m1 }}</td>
                                                <td>{{ $zone->cur_etat_nonresi_bf_m2 }}</td>
                                                <td>{{ $zone->cur_etat_nonresi_bf_m3 }}</td>
                                                <td>{{ $zone->cur_etat_nonresi_afr_m1 }}</td>
                                                <td>{{ $zone->cur_etat_nonresi_afr_m2 }}</td>
                                                <td>{{ $zone->cur_etat_nonresi_afr_m3 }}</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($zone->created_at)->format('d/m/Y') }}
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5">
                                                    <span class="text-danger">
                                                        <strong>Le volume du baromètre n existe pas!</strong>
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{-- {{ $zone->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
