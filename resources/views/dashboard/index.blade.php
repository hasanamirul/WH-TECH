@extends('layouts.app')

@section('content')
<div class="grid">
  <!-- top 3 small cards -->
  <div class="col-4 card small">
    <div style="display:flex;justify-content:space-between;align-items:center">
      <div>
        <div style="font-size:13px;color:#6b7280">Dosen</div>
        <div style="font-size:22px;font-weight:700">271</div>
      </div>
      <div style="width:60px;height:30px;border-radius:8px;background:#3b82f6"></div>
    </div>
  </div>

  <div class="col-4 card small">
    <div style="display:flex;justify-content:space-between;align-items:center">
      <div>
        <div style="font-size:13px;color:#6b7280">Dosen</div>
        <div style="font-size:22px;font-weight:700">271</div>
      </div>
      <div style="width:60px;height:30px;border-radius:8px;background:#34d399"></div>
    </div>
  </div>

  <div class="col-4 card small">
    <div style="display:flex;justify-content:space-between;align-items:center">
      <div>
        <div style="font-size:13px;color:#6b7280">Pegawai Aktif</div>
        <div style="font-size:22px;font-weight:700">182</div>
      </div>
      <div style="width:60px;height:30px;border-radius:8px;background:#f59e0b"></div>
    </div>
  </div>

  <!-- main charts -->
  <div class="col-8 card">
    <div style="font-weight:600;margin-bottom:12px">Jabatan Akademik Dosen</div>
    <canvas id="barChart" style="height:220px"></canvas>
  </div>

  <div class="col-4 card">
    <div style="font-weight:600;margin-bottom:12px">Jumlah Dosen Berdasarkan Jenis Kelamin</div>
    <canvas id="pieChart" style="height:220px"></canvas>
    <div style="margin-top:8px">
      <div style="display:flex;gap:12px;align-items:center"><span style="width:12px;height:12px;background:#3b82f6;display:inline-block;border-radius:3px"></span> Laki-laki</div>
      <div style="display:flex;gap:12px;align-items:center;margin-top:6px"><span style="width:12px;height:12px;background:#ef4565;display:inline-block;border-radius:3px"></span> Perempuan</div>
    </div>
  </div>

  <div class="col-8 card" style="min-height:200px;margin-top:6px">
    <div style="font-weight:600;margin-bottom:12px">Jabatan Akademik Tendik</div>
    <div style="text-align:center;color:#94a3b8;padding:30px">Tidak Ada Data</div>
  </div>

  <div class="col-4 card" style="min-height:200px;margin-top:6px">
    <div style="font-weight:600;margin-bottom:12px">Jumlah Tendik Berdasarkan Jenis Kelamin</div>
    <canvas id="pieChart2" style="height:160px"></canvas>
  </div>
</div>

@push('scripts')
<script>
  // BAR CHART
  const ctxBar = document.getElementById('barChart').getContext('2d');
  new Chart(ctxBar, {
    type: 'bar',
    data: {
      labels: ['Asisten Ahli','Lektor','Kepala Lektor','Guru Besar'],
      datasets: [{
        label: 'Jumlah',
        data: [40,120,90,30],
        backgroundColor: ['#f59e0b','#3b82f6','#ef4565','#34d399'],
        borderRadius:6,
      }]
    },
    options: {
      plugins:{legend:{display:false}},
      scales:{
        y:{beginAtZero:true,grid:{display:false}},
        x:{grid:{display:false}}
      }
    }
  });

  // PIE CHART 1
  new Chart(document.getElementById('pieChart'), {
    type:'doughnut',
    data:{
      labels:['Laki-Laki','Perempuan'],
      datasets:[{data:[160,111], backgroundColor:['#3b82f6','#ef4565']}]
    },
    options:{cutout:'65%'}
  });

  // PIE CHART 2
  new Chart(document.getElementById('pieChart2'), {
    type:'doughnut',
    data:{
      labels:['Laki-Laki','Perempuan'],
      datasets:[{data:[90,60], backgroundColor:['#3b82f6','#ef4565']}]
    },
    options:{cutout:'65%'}
  });
</script>
@endpush
@endsection
