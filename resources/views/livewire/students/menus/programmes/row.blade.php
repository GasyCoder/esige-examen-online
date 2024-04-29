<tr>
    <td><span class="badge bg-primary-soft">{{ $programme->title }}</span></td>
    <td>{{ $programme->dateDebut->format('d/m/Y') }}</td>
    <td>{{ $programme->dateFin->format('d/m/Y') }}</td>
    <td><small>{{ $programme->notes }}</small></td>
    <td>
        @if($programme->status)
        <span class="badge bg-warning-soft">Même niveau</span>
        @else
        <span class="badge bg-danger-soft">Commun</span>
        @endif
    </td>
</tr>