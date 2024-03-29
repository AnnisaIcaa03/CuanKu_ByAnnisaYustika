@extends('layouts.default')

@section('content')
<!-- Animated -->
<div class="animated fadeIn">
    <!-- Widgets  -->
    <div class="row">
        <div class="col-12 col-sm-6">
            <div class="card card-money">
                <div class="card-body card-money-body">
                    <div class="card-body-text">
                        <h4>Saldo</h4>
                        <a href="#mymodal" data-remote="{{ route('moneys.create') }}" data-toggle="modal"
                            data-target="#mymodal" data-title="Tambah Uang Anda">+ Tambah</a>
                    </div>
                    <h2 class="money">Rp.{{ $moneytotal->amount }},00</h2>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="card card-money">
                <div class="card-body card-money-body">
                    <div class="card-body-text">
                        <h4>Detail</h4>
                    </div>

                    <dl class="row mb-1">
                        <dt class="col-3 offset-3">Ingin</dt>
                        <dd class="col-5 offset-1">Rp.{{ $want->amount }},00</dd>
                        <dt class="col-3 offset-3">Prioritas</dt>
                        <dd class="col-5 offset-1">Rp.{{ $essential->amount }},00</dd>
                        <dt class="col-3 offset-3">Tabungan</dt>
                        <dd class="col-5 offset-1">Rp.{{ $saving->amount }},00</dd>
                    </dl>
                </div>
            </div>
        </div>


    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-sm-6">
            <div class="card card-money">
                <div class="card-body card-money-body">
                    <div class="card-body-text">
                        <h4>Tabungan</h4>
                    </div>
                    <h2 class="money">Rp.{{ $bank->amount }},00</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Widgets -->
    <!-- Orders -->
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="box-title">
                            Riwayat Aktivitas
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th class="d-none d-md-table-cell">Lokasi</th>
                                        <th>Harga (Rupiah)</th>
                                        <th>Tipe</th>
                                        <th class="d-none d-md-table-cell">Tanggal</th>
                                        <th class="d-none d-md-table-cell"></th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @forelse ($items as $item)
                                    <tr class="bg-light">
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="d-none d-md-table-cell">{{ $item->location }}</td>
                                        <td>Rp. {{ $item->price }},00</td>
                                        <td>{{ $item->type }}</td>
                                        <td class="d-none d-md-table-cell">{{ $item->date }}</td>
                                        <td class="d-none d-md-table-cell">{{ $item->time }}</td>
                                        <td>
                                            @if ($item->status=="Failed")
                                            <span class="badge badge-danger">
                                                @elseif ($item->status=="Success")
                                                <span class="badge badge-complete">
                                                    @else
                                                    <span>
                                                        @endif
                                                        {{$item->status}}</span>
                                        </td>
                                    </tr>
                                    <?php $i++ ; ?>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center p-5">
                                            Data tidak tersedia
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-stats -->
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-lg-8 -->
        </div>
    </div>
    <!-- /.orders -->
    <!-- /#add-category -->
</div>
<!-- .animated -->
<div class="col-xl-7 chart" style="margin: 0 auto;">
    <div class="card card-chart">
        <h3 class="card-header">Beban Alokasi</h3>
        <div class="chart-container ov-h">
            <div id="flotPie1" class="float-chart"></div>
        </div>
        <div class="legend-chart">
            <h4 class="essentials">
                <i class="menu-icon fa fa-cubes"></i> Tabungan
            </h4>
            <h4 class="wants">
                <i class="menu-icon fa fa-cubes"></i> Ingin
            </h4>
            <h4 class="savings">
                <i class="menu-icon fa fa-cubes"></i> Prioritas
            </h4>
        </div>
    </div>
</div>

@endsection

@push('after-script')
<!--Local Stuff-->
<script>
    jQuery(document).ready(function ($) {
        "use strict";

        // Pie chart flotPie1
        var piedata = [{
                label: "Essentials",
                data: [
                    [0, {{ $pie['essential'] }} ]
                ],
                color: '#5c6bc0'
            },
            {
                label: "Want",
                data: [
                    [0, {{ $pie['want'] }}]
                ],
                color: '#ef5350'
            },
            {
                label: "Saving",
                data: [
                    [0, {{ $pie['store'] }}]
                ],
                color: '#66bb6a'
            }
        ];

        $.plot('#flotPie1', piedata, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    innerRadius: 0.65,
                    label: {
                        show: true,
                        radius: 2 / 3,
                        threshold: 1
                    },
                    stroke: {
                        width: 0
                    }
                }
            },
            grid: {
                hoverable: true,
                clickable: true
            }
        });
        // Pie chart flotPie1  End
        // cellPaiChart
        var cellPaiChart = [{
                label: "Direct Sell",
                data: [
                    [1, 65]
                ],
                color: '#5b83de'
            },
            {
                label: "Channel Sell",
                data: [
                    [1, 35]
                ],
                color: '#00bfa5'
            }
        ];
        $.plot('#cellPaiChart', cellPaiChart, {
            series: {
                pie: {
                    show: true,
                    stroke: {
                        width: 0
                    }
                }
            },
            legend: {
                show: false
            },
            grid: {
                hoverable: true,
                clickable: true
            }

        });
        // cellPaiChart End
        // Line Chart  #flotLine5
        var newCust = [
            [0, 3],
            [1, 5],
            [2, 4],
            [3, 7],
            [4, 9],
            [5, 3],
            [6, 6],
            [7, 4],
            [8, 10]
        ];

        var plot = $.plot($('#flotLine5'), [{
            data: newCust,
            label: 'New Data Flow',
            color: '#fff'
        }], {
            series: {
                lines: {
                    show: true,
                    lineColor: '#fff',
                    lineWidth: 2
                },
                points: {
                    show: true,
                    fill: true,
                    fillColor: "#ffffff",
                    symbol: "circle",
                    radius: 3
                },
                shadowSize: 0
            },
            points: {
                show: true,
            },
            legend: {
                show: false
            },
            grid: {
                show: false
            }
        });
        // Line Chart  #flotLine5 End
        // Traffic Chart using chartist
        if ($('#traffic-chart').length) {
            var chart = new Chartist.Line('#traffic-chart', {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                series: [
                    [0, 18000, 35000, 25000, 22000, 0],
                    [0, 33000, 15000, 20000, 15000, 300],
                    [0, 15000, 28000, 15000, 30000, 5000]
                ]
            }, {
                low: 0,
                showArea: true,
                showLine: false,
                showPoint: false,
                fullWidth: true,
                axisX: {
                    showGrid: true
                }
            });

            chart.on('draw', function (data) {
                if (data.type === 'line' || data.type === 'area') {
                    data.element.animate({
                        d: {
                            begin: 2000 * data.index,
                            dur: 2000,
                            from: data.path.clone().scale(1, 0).translate(0, data.chartRect
                                .height()).stringify(),
                            to: data.path.clone().stringify(),
                            easing: Chartist.Svg.Easing.easeOutQuint
                        }
                    });
                }
            });
        }
        // Traffic Chart using chartist End
        //Traffic chart chart-js
        if ($('#TrafficChart').length) {
            var ctx = document.getElementById("TrafficChart");
            ctx.height = 150;
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                    datasets: [{
                            label: "Visit",
                            borderColor: "rgba(4, 73, 203,.09)",
                            borderWidth: "1",
                            backgroundColor: "rgba(4, 73, 203,.5)",
                            data: [0, 2900, 5000, 3300, 6000, 3250, 0]
                        },
                        {
                            label: "Bounce",
                            borderColor: "rgba(245, 23, 66, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(245, 23, 66,.5)",
                            pointHighlightStroke: "rgba(245, 23, 66,.5)",
                            data: [0, 4200, 4500, 1600, 4200, 1500, 4000]
                        },
                        {
                            label: "Targeted",
                            borderColor: "rgba(40, 169, 46, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(40, 169, 46, .5)",
                            pointHighlightStroke: "rgba(40, 169, 46,.5)",
                            data: [1000, 5200, 3600, 2600, 4200, 5300, 0]
                        }
                    ]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    }

                }
            });
        }
        //Traffic chart chart-js  End
        // Bar Chart #flotBarChart
        $.plot("#flotBarChart", [{
            data: [
                [0, 18],
                [2, 8],
                [4, 5],
                [6, 13],
                [8, 5],
                [10, 7],
                [12, 4],
                [14, 6],
                [16, 15],
                [18, 9],
                [20, 17],
                [22, 7],
                [24, 4],
                [26, 9],
                [28, 11]
            ],
            bars: {
                show: true,
                lineWidth: 0,
                fillColor: '#ffffff8a'
            }
        }], {
            grid: {
                show: false
            }
        });
        // Bar Chart #flotBarChart End
    });

</script>
@endpush
