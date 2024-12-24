@extends('layouts.app')
@section('contenus')
    <div class="container">
        <div class="page-inner">
            <div class="row justify-content-center mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-start">
                                <h4><strong>Information sur le volume de l activite</strong></h4>
                            </div>
                            <div class="float-end">
                                {{-- <a href="{{ route('zone.index') }}" class="btn btn-primary"><i class="fas fa-angle-double-right"></i> Suivante</a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Circuits inter-Etats</th>
                                                <th scope="col">Circuits internes</th>
                                                <th scope="col">Excursions</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($zone as $zone)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $zone->cur_etat_resi_nat_m1 }}</td>
                                                <td>{{ $zone->cur_intr_resi_nat_m1 }}</td>
                                                <td>{{ $zone->EXCURSIONS }}</td>
                                                <td>
                                                    <form action="{{ route('zone.destroy', $zone->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <a href="{{ route('zone.show', $zone->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> Show</a>

                                                        <a href="{{ route('zone.edit', $zone->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>

                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous supprimer la volume de l activite ?');"><i class="fas fa-trash-alt"></i> Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                                <td colspan="6">
                                                    <span class="text-danger">
                                                        <strong>Volume de l activite existe pas!</strong>
                                                    </span>
                                                </td>
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