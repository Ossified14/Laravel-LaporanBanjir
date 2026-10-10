<div class="card report-card">
    <div class="card-body">
        <h3 class="report-title">{{ $laporan['nama'] }}</h3>
        <p class="report-location">📍 {{ $laporan['lokasi'] }}</p>
        
        <div class="report-details">
            <span class="report-height">Genangan: <strong>{{ $laporan['tinggi_genangan'] }} cm</strong></span>
            
            {{-- Status bahaya berdasarkan if/elseif/else --}}
            @if ($laporan['tinggi_genangan'] < 30)
                <span class="bahaya-badge bahaya-waspada">Waspada (&lt; 30 cm)</span>
            @elseif ($laporan['tinggi_genangan'] <= 70)
                <span class="bahaya-badge bahaya-siaga">Siaga (30 - 70 cm)</span>
            @else
                <span class="bahaya-badge bahaya-awas">Awas (&gt; 70 cm)</span>
            @endif
        </div>
        
        <p class="report-time text-muted">Dilaporkan pada: {{ $laporan['waktu'] }}</p>
    </div>
</div>

<style>
/* CSS khusus untuk card laporan agar terlihat rapi */
.report-card {
    margin-bottom: var(--s3);
    border: 1px solid var(--color-border);
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.report-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.report-title {
    font-size: 1.1rem;
    color: var(--color-primary-dark);
    margin-bottom: var(--s1);
}
.report-location {
    font-weight: 500;
    margin-bottom: var(--s3);
}
.report-details {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: var(--color-bg);
    padding: var(--s2) var(--s3);
    border-radius: var(--radius-sm);
    margin-bottom: var(--s3);
}
.report-height strong {
    font-size: 1.1rem;
}
.report-time {
    font-size: 0.8rem;
    text-align: right;
}
.text-muted {
    color: var(--color-text-muted);
}
</style>
