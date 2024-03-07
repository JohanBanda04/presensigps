<form action="/datasatker/{{ $berita->id_berita }}/updateberita" method="post" id="frmSatkerBeritaEdit" name="frmSatkerBeritaEdit"
      enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user"
                         width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                         stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/><path
                                d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
                                    </svg>
                </span>
                <input readonly type="text" value="{{ $berita->kode_satker }}" class="form-control"
                       name="kode_satker"
                       id="kode_satker"
                       placeholder="Kode Satker">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="icon icon-tabler icon-tabler-file-barcode" width="24" height="24"
                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round"><path stroke="none"
                                                                              d="M0 0h24v24H0z"
                                                                              fill="none"/><path
                                d="M14 3v4a1 1 0 0 0 1 1h4"/><path
                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"/><path
                                d="M8 13h1v3h-1z"/><path d="M12 13v3"/><path d="M15 13h1v3h-1z"/>
                                    </svg>
                </span>
                <input type="text" value="{{ $berita->nama_berita }}" class="form-control"
                       name="judul_berita_satker"
                       id="judul_berita_satker"
                       placeholder="Judul Berita">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-link"
                         width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                d="M9 15l6 -6"/><path
                                d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"/><path
                                d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"/>
                                   </svg>
                </span>
                <input type="text" value="{{ $berita->facebook }}" class="form-control"
                       name="facebook"
                       id="facebook"
                       placeholder="Link Facebook">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-link"
                         width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                d="M9 15l6 -6"/><path
                                d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"/><path
                                d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"/>
                                   </svg>
                </span>
                <input type="text" value="{{ $berita->website }}" class="form-control"
                       name="website"
                       id="website"
                       placeholder="Link Website">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-link"
                         width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                d="M9 15l6 -6"/><path
                                d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"/><path
                                d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"/>
                                   </svg>
                </span>
                <input type="text" value="{{ $berita->instagram }}" class="form-control"
                       name="instagram"
                       id="instagram"
                       placeholder="Link Instagram">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-link"
                         width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                d="M9 15l6 -6"/><path
                                d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"/><path
                                d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"/>
                                   </svg>
                </span>
                <input type="text" value="{{ $berita->twitter }}" class="form-control"
                       name="twitter"
                       id="twitter"
                       placeholder="Link Twitter">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-link"
                         width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                d="M9 15l6 -6"/><path
                                d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"/><path
                                d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"/>
                                   </svg>
                </span>
                <input type="text" value="{{ $berita->tiktok }}" class="form-control"
                       name="tiktok"
                       id="tiktok"
                       placeholder="Link Tiktok">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-link"
                         width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                d="M9 15l6 -6"/><path
                                d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"/><path
                                d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"/>
                                   </svg>
                </span>
                <input type="text" value="{{ $berita->sippn }}" class="form-control"
                       name="sippn"
                       id="sippn"
                       placeholder="Link SIPPN">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-link"
                         width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                d="M9 15l6 -6"/><path
                                d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"/><path
                                d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"/>
                                   </svg>
                </span>
                <input type="text" value="{{ $berita->sippn }}" class="form-control"
                       name="sippn"
                       id="sippn"
                       placeholder="Link SIPPN">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-link"
                         width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" fill="none" stroke-linecap="round"
                         stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path
                                d="M9 15l6 -6"/><path
                                d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"/><path
                                d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"/>
                                   </svg>
                </span>
                <input type="text" value="{{ $berita->youtube }}" class="form-control"
                       name="youtube"
                       id="youtube"
                       placeholder="Link Youtube">
            </div>
        </div>
    </div>
    <div class="row" style="margin-bottom: 10px; margin-top: 15px;">
        <div class="col-12">
            <div class="form-group">
                <div class="input_fields_wrap_edit">
                    <center><label class="col-lg-12 " style="">Link Tambahan (Media LokaL)</label>
                    </center>
                    <button class="add_field_button_edit btn btn-success m-l-15 col-lg-12 "
                            style="margin-bottom: 15px;">
                        Tambah Kolom Media Lokal
                    </button>

                    <?php
                    $links_media_lokal = json_decode($berita->media_lokal);
                    ?>
                    @foreach($links_media_lokal??[] as $key=>$link)

                        <li class="col-lg-12" style="display: flex ;   "
                            id="list-file-<?= $key; ?>-<?= $berita->id_berita; ?>">
                            <div class="form-group col-lg-12 m-b-1"
                                 style="justify-content: space-between; overflow: auto">

                                <input value="{{ $link }}" type="text" name="jumlah_edit[]" class="form-control "
                                       placeholder="Link Media Lokal">

                                <a style="" href="javascript:;"
                                   class="remove_field_edit"
                                   onclick="deleteFile('<?php echo $link;?>','<?= $key; ?>', '<?= $berita->id_berita; ?>')">
                                    <i class="fa fa-trash btn btn-danger">Remove</i>
                                </a>
                            </div>
                        </li>


                        {{--<div class="col-lg-12" style=""--}}
                        {{--id="list-file-{{ $key }}-{{ $berita->id_berita }}">--}}
                        {{--<table class="m-l-15 col-lg-12" id="">--}}
                        {{--<tr class="">--}}
                        {{--<td class="" style="">--}}
                        {{--<input value="{{ $link }}" type="text" name="jumlah_edit[]" class="form-control "--}}
                        {{--placeholder="Link Media Lokal">--}}
                        {{--</td>--}}
                        {{--</tr>--}}
                        {{--</table>--}}
                        {{--<a href="javascript:;" onclick="deleteFile('{{ $link }}','{{ $key }}',{{ $berita->id_berita }})"--}}
                        {{--style="margin-left: 10px;" class="remove_field_edit">--}}
                        {{--Remove--}}
                        {{--</a>--}}
                        {{--</div>--}}


                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-bottom: 10px; margin-top: 15px;">
        <div class="col-12">
            <div class="form-group">
                <div class="input_fields_wrap_edit_nasional">
                    <center><label class="col-lg-12 " style="">Link Tambahan (Media NasionaL)</label>
                    </center>
                    <button class="add_field_button_edit_nasional btn btn-warning m-l-15 col-lg-12 "
                            style="margin-bottom: 15px;">
                        Tambah Kolom Media Nasional
                    </button>
                    <?php
                    $links_media_nasional = json_decode($berita->media_nasional);
                    ?>
                    @foreach($links_media_nasional??[] as $key_nasional=>$link_nasional)
                        <li class="col-lg-12" style="display: flex ;   "
                            id="list-file-<?= $key_nasional; ?>-<?= $berita->id_berita; ?>">
                            <div class="form-group col-lg-12 m-b-1"
                                 style="justify-content: space-between; overflow: auto">
                                <input value="{{ $link_nasional }}" type="text" name="jumlah_edit_nasional[]"
                                       class="form-control "
                                       placeholder="Link Media Nasional">

                                <a style="" href="javascript:;"
                                   class="remove_field_edit_nasional"
                                   onclick="deleteFileNasional('<?php echo $link_nasional;?>','<?= $key_nasional; ?>', '<?= $berita->id_berita; ?>')">
                                    <i class="fa fa-trash btn btn-danger">Remove</i>
                                </a>
                            </div>
                        </li>
                    @endforeach
                    {{--<?php--}}
                    {{--$links_media_nasional = json_decode($berita->media_nasional);--}}
                    {{--?>--}}
                    {{--@foreach($links_media_nasional as $key=>$link_nasional)--}}

                    {{--<table class="m-l-15 col-lg-12">--}}

                    {{--<tr class="">--}}

                    {{--<td class="" style="">--}}
                    {{--<label for="">Berita Media Lokal</label>--}}
                    {{--<input value="{{ $link_nasional }}" type="text" name="jumlah_edit_nasional[]"--}}
                    {{--class="form-control "--}}
                    {{--placeholder="Link Media Nasional">--}}
                    {{--</td>--}}
                    {{--</tr>--}}


                    {{--</table>--}}
                    {{--<a href="#" style="margin-left: 10px;" class="remove_field_nasional">Remove</a>--}}

                    {{--@endforeach--}}

                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="form-group">
                <button class="btn btn-primary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24"
                         height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"/>
                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"/>
                    </svg>
                    Update
                </button>
            </div>
        </div>
    </div>


</form>
<script type="text/javascript">

    $(document).ready(function () {
        console.log("ready!");

        //$('#lamp_surat_permohonan_edit').prop('required', true);
        //$('#draft_harmonisasi_edit').prop('required', true);
        //$('#naskah_akademik_edit').prop('required', false);

    });


    var count = 0;

    function deleteFile_old($link, $key, $id_berita) {
        // $path = nama file;
        // $file_id = index file dari record db;
        // $row_id= id unique;
        // confirm("Hapus File?",);
        if (confirm("Hapus File Lampiran?") == true) {
            $.post("/datasatker/hapuslink", {

                link: $link,
                key: $key,
                id_berita: $id_berita,
            }).done(function (response) {
                // console.log(response);
                console.log("tes");
                //$("#list-file-"+$file_id+"-"+$row_id).remove();
                $("#list-file-" + key + "-" + id_berita).remove();
            });
        }

        // alert("tesss");

    }

    function deleteFile($link, $key, $id_berita) {
        //alert($link)
        var link = link;
        var key = $key;
        var id_berita = $id_berita;
        //alert($id_berita);
        // $path = nama file;
        // $file_id = index file dari record db;
        // $row_id= id unique;
        // confirm("Hapus File?",);
        if (confirm("Hapus Link Berita?") == true) {
            //alert("confirmed");
            $.ajax({
                type: 'POST',
                url: '/datasatker/editberita/hapuslink',
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    id_berita: $id_berita,
                    key: $key,
                    link: $link,
                },
                success: function (respond) {
                    console.log(respond);
                    // $("#list-file-"+key+"-"+id_berita).remove();
                }

            });
            // $.post("pemda/v/df",{
            //
            //     path : $path,
            //     file_id : $file_id,
            //     id : $row_id,
            // }).done(function (response) {
            //     // console.log(response);
            //     console.log($path+" "+$file_id+" "+$row_id);
            //     $("#list-file-"+$file_id+"-"+$row_id).remove();
            // });
        }

        // alert("tesss");

    }

    function deleteFileNasional($link_nasional, $key_nasional, $id_berita) {
        var link_nasional = $link_nasional;
        var key_nasional = $key_nasional;
        var id_berita = $id_berita;

        if (confirm("Hapus Link Berita Nasional?") == true) {
            $.ajax({
                type: 'POST',
                url: '/datasatker/editberita/hapuslink_nasional',
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    id_berita_nasional: $id_berita,
                    key_nasional: $key_nasional,
                    link_nasional: $link_nasional,
                },
                success: function (respond) {
                    console.log(respond);
                },
            });
        }
    }


</script>
<script>
    $(function () {

        var max_fields = 100;
        var max_fields_nasional = 100;

        var add_button_edit = $(".add_field_button_edit");
        var add_button_edit_nasional = $(".add_field_button_edit_nasional");

        var wrapper_edit = $(".input_fields_wrap_edit");
        var wrapper_edit_nasional = $(".input_fields_wrap_edit_nasional");

        var x = 1;
        var x_nasional = 1;

        $(add_button_edit).click(function (e) {
            e.preventDefault();
            // alert("tes");
            if (x < max_fields) { //max input box allowed
                x++; //text box increment

                $(wrapper_edit).append('<div>' +
                    '<table class="m-l-15 col-lg-12" style="">' +
                    '<tr style="margin-top: 10px">' +
                    '<td>' +


                    '</td>' +
                    '<td style=""><input type="text" name="jumlah_edit[]" class="form-control"  placeholder="Link Media Lokal" >' +
                    '</td>' +
                    '</tr>' +
                    '</table>' +
                    '<a href="#" style="margin-left: 10px; margin-top:5px; margin-bottom: 5px;" class="remove_field_edit"><i class="fa fa-trash btn btn-danger">Remove</i></a></div>');
                $('.myselect').select2();
            }
        });

        $(wrapper_edit).on("click", ".remove_field_edit", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });

        $(add_button_edit_nasional).click(function (e) {
            e.preventDefault();
            // alert("tes");
            if (x_nasional < max_fields) { //max input box allowed
                x_nasional++; //text box increment

                $(wrapper_edit_nasional).append('<div>' +
                    '<table class="m-l-15 col-lg-12" style="">' +
                    '<tr style="margin-top: 10px">' +
                    '<td>' +


                    '</td>' +
                    '<td style=""><input type="text" name="jumlah_edit_nasional[]" class="form-control"  placeholder="Link Media Nasional" >' +
                    '</td>' +
                    '</tr>' +
                    '</table>' +
                    '<a href="#" style="margin-left: 10px;" class="remove_field_edit_nasional"><i class="fa fa-trash btn btn-danger">Remove</i></a></div>');
                $('.myselect').select2();
            }
        });


        $(wrapper_edit_nasional).on("click", ".remove_field_edit_nasional", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
    });
</script>