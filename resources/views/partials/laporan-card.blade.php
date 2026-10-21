<div class="card report-card">
    <div class="card-body">
        <h3 class="report-title">{{ $laporan->nama_pelapor }}</h3>
        <p class="report-location">📍 {{ $laporan->lokasi }}</p>

        <div class="report-details">
            <span class="report-height">Genangan: <strong>{{ $laporan->tinggi_genangan }} cm</strong></span>

            {{-- Status bahaya berdasarkan tinggi genangan --}}
            @if ($laporan->tinggi_genangan <= 30)
                <span class="bahaya-badge bahaya-waspada">Waspada (&lt;= 30 cm)</span>
            @elseif ($laporan->tinggi_genangan <= 70)
                <span class="bahaya-badge bahaya-siaga">Siaga (31 &ndash; 70 cm)</span>
            @else
                <span class="bahaya-badge bahaya-awas">Awas (&gt; 70 cm)</span>
            @endif
        </div>

        <p class="report-time text-muted">
            Dilaporkan pada:
            {{ \Carbon\Carbon::parse($laporan->tanggal_kejadian)->locale('id')->isoFormat('dddd, D MMMM Y') }}
        </p>
    </div>
</div>

<style>
.report-card {
    margin-bottom: 1rem;
    border: 1px solid #e0e0e0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: box-shadow 0.2s;
}
.report-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.report-title {
    font-size: 1.1rem;
    color: #1a1a2e;
    margin-bottom: 0.3rem;
}
.report-location {
    font-weight: 500;
    margin-bottom: 0.8rem;
    color: #555;
}
.report-details {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f5f5f5;
    padding: 0.6rem 0.9rem;
    border-radius: 6px;
    margin-bottom: 0.8rem;
}
.report-height strong { font-size: 1.1rem; }
.report-time {
    font-size: 0.82rem;
    text-align: right;
    color: #aaa;
}
</style>