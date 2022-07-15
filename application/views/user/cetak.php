<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/'); ?>css/cetak.css">
</head>


<body translate="no" onload="window.print();">
    <div id="invoice-POS">
        <div id="mid">
            <div class="info">
                <h3>Nota Pembayaran</h3>
                <p>
                    Tgl : <?php echo format_indo($nota['tgl_nota']); ?></br>
                    No Nota : <?php echo $nota['no_nota']; ?></br>
                    Petugas : <?php echo $user['nama']; ?></br>
                </p>
            </div>
        </div>
        <div id="bot">
            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td></td>
                        <td class="itemtext">
                            <h2>Item</h2>
                        </td>
                        <td class="itemtext">
                            <h2>Harga</h2>
                        </td>
                        <td class="itemtext">
                            <h2>Qty</h2>
                        </td>
                        <td class="itemtext">
                            <h2>Total</h2>
                        </td>
                    </tr>
                    <tr class="tabletitle">
                        <td></td>
                        <td class="tableitem">
                            <p class="itemtext">Sewa <?php echo $nota['nama_mobil']; ?></p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">Rp <?php echo rupiah($nota['harga_sewa']); ?>/hari</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext"><?php echo $nota['jml_sewa']; ?> hari</p>
                        </td>
                        <td class="tableitem">
                            <p class="itemtext">Rp <?php echo rupiah($nota['tot_bayar']); ?></p>
                        </td>
                    </tr>
                    <?php foreach ($detail as $lu) : ?>
                        <tr class="tabletitle">
                            <td></td>
                            <td class="tableitem">
                                <p class="itemtext"><?php echo $lu['nama_biaya']; ?></p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">Rp. <?php echo rupiah($lu['harga_biaya']); ?></p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext"><?php echo $lu['qty']; ?></p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">Rp. <?php echo rupiah($lu['sub_total']); ?></p>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="tabletitle">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="itemtext">
                            <h2>Grand Total</h2>
                        </td>
                        <td class="itemtext">
                            <h2>Rp. <?php echo rupiah($grand_total['grand_total']); ?></h2>
                        </td>
                    </tr>
                </table>
            </div>
            <hr>
            <div id="legalcopy">
                <p class="legal"><strong>
                        <center>Terima Kasih Atas Kepercayaan Anda
                        </center>
                    </strong>
                </p>
            </div>
        </div>
    </div>

</html>