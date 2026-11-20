<?php

include_once("Template.php");

class DepartmentView
{
    public function render($data, $dataDetail = null)
    {
        $no = 1;
        $dataDepartment = "";

        if (empty($data['department'])) {
            $dataDepartment = "<tr><td colspan='7' class='text-center py-4 text-muted'>Belum ada data departemen.</td></tr>";
        } else {
            foreach ($data['department'] as $val) {
                $id = $val['id'];
                $code = htmlspecialchars($val['code']);
                $name = htmlspecialchars($val['name']);
                $faculty = htmlspecialchars($val['faculty']);
                $total_lecturers = (int)($val['total_lecturers'] ?? 0);
                $total_courses = (int)($val['total_courses'] ?? 0);

                $dataDepartment .= "<tr>
                    <td class='ps-3 text-secondary'>{$no}</td>
                    <td><span class='badge bg-light text-dark border font-monospace'>{$code}</span></td>
                    <td class='fw-semibold text-dark'>{$name}</td>
                    <td>{$faculty}</td>
                    <td class='text-center'><span class='badge bg-info bg-opacity-25 text-dark'>{$total_lecturers} Dosen</span></td>
                    <td class='text-center'><span class='badge bg-success bg-opacity-25 text-dark'>{$total_courses} Matkul</span></td>
                    <td class='text-center'>
                        <a href='department.php?id_edit={$id}' class='btn btn-sm btn-outline-warning me-1' title='Edit Departemen'>
                            <i class='fa-solid fa-pen-to-square'></i> Edit
                        </a>
                        <a href='department.php?id_hapus={$id}' class='btn btn-sm btn-outline-danger' title='Hapus Departemen' onclick=\"return confirm('Yakin ingin menghapus departemen ini?')\">
                            <i class='fa-solid fa-trash-can'></i> Hapus
                        </a>
                    </td>
                </tr>";
                $no++;
            }
        }

        $tpl = new Template("templates/department.html");
        $tpl->replace("DATA_TITLE", "Departments");
        $tpl->replace("DATA_TABEL", $dataDepartment);

        if ($dataDetail) {
            $tpl->replace("DATA_TITLE_FORM", "Ubah Data Departemen");
            $tpl->replace("DATA_VAL_ID", $dataDetail['id']);
            $tpl->replace("DATA_VAL_CODE", htmlspecialchars($dataDetail['code']));
            $tpl->replace("DATA_VAL_NAME", htmlspecialchars($dataDetail['name']));
            $tpl->replace("DATA_VAL_FACULTY", htmlspecialchars($dataDetail['faculty']));
            $tpl->replace("DATA_BUTTON_NAME", "edit");
            $tpl->replace("DATA_BUTTON_TEXT", "Perbarui Departemen");
            $tpl->replace("DATA_CANCEL_BUTTON", "<a href='department.php' class='btn btn-outline-secondary'>Batal Edit</a>");
        } else {
            $tpl->replace("DATA_TITLE_FORM", "Tambah Departemen Baru");
            $tpl->replace("DATA_VAL_ID", "");
            $tpl->replace("DATA_VAL_CODE", "");
            $tpl->replace("DATA_VAL_NAME", "");
            $tpl->replace("DATA_VAL_FACULTY", "FPMIPA");
            $tpl->replace("DATA_BUTTON_NAME", "add");
            $tpl->replace("DATA_BUTTON_TEXT", "Simpan Departemen");
            $tpl->replace("DATA_CANCEL_BUTTON", "");
        }

        $tpl->write();
    }
}
?>
