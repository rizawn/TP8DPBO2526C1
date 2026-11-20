<?php

include_once("Template.php");

class LecturerView
{
    public function render($data, $dataDetail = null)
    {
        $no = 1;
        $dataLecturer = "";
        $dataDepartmentOption = "";

        if (empty($data['lecturer'])) {
            $dataLecturer = "<tr><td colspan='7' class='text-center py-4 text-muted'>Belum ada data dosen terdaftar.</td></tr>";
        } else {
            foreach ($data['lecturer'] as $val) {
                $id = $val['id'];
                $name = htmlspecialchars($val['name']);
                $nidn = htmlspecialchars($val['nidn']);
                $phone = htmlspecialchars($val['phone']);
                $join_date = htmlspecialchars($val['join_date']);
                $dept_name = !empty($val['department_name']) ? htmlspecialchars($val['department_name']) : "<span class='text-muted fst-italic'>Belum diatur</span>";

                $dataLecturer .= "<tr>
                    <td class='ps-3 text-secondary'>{$no}</td>
                    <td class='fw-semibold text-dark'>{$name}</td>
                    <td><span class='badge bg-light text-dark border font-monospace'>{$nidn}</span></td>
                    <td>{$phone}</td>
                    <td>" . date('d M Y', strtotime($join_date)) . "</td>
                    <td><span class='badge bg-primary bg-opacity-10 text-primary'>{$dept_name}</span></td>
                    <td class='text-center'>
                        <a href='index.php?id_edit={$id}' class='btn btn-sm btn-outline-warning me-1' title='Edit Dosen'>
                            <i class='fa-solid fa-pen-to-square'></i> Edit
                        </a>
                        <a href='index.php?id_hapus={$id}' class='btn btn-sm btn-outline-danger' title='Hapus Dosen' onclick=\"return confirm('Yakin ingin menghapus dosen ini?')\">
                            <i class='fa-solid fa-trash-can'></i> Hapus
                        </a>
                    </td>
                </tr>";
                $no++;
            }
        }

        $selectedDeptId = $dataDetail ? $dataDetail['department_id'] : null;
        if (!empty($data['department'])) {
            foreach ($data['department'] as $dept) {
                $deptId = $dept['id'];
                $deptName = htmlspecialchars($dept['name']);
                $deptCode = htmlspecialchars($dept['code']);
                $isSelected = ($selectedDeptId == $deptId) ? "selected" : "";
                $dataDepartmentOption .= "<option value='{$deptId}' {$isSelected}>{$deptName} ({$deptCode})</option>";
            }
        }

        $tpl = new Template("templates/index.html");
        $tpl->replace("DATA_TITLE", "Lecturers");
        $tpl->replace("DATA_TABEL", $dataLecturer);
        $tpl->replace("DATA_DEPARTMENT_OPTION", $dataDepartmentOption);

        if ($dataDetail) {
            $tpl->replace("DATA_TITLE_FORM", "Ubah Data Dosen");
            $tpl->replace("DATA_VAL_ID", $dataDetail['id']);
            $tpl->replace("DATA_VAL_NAME", htmlspecialchars($dataDetail['name']));
            $tpl->replace("DATA_VAL_NIDN", htmlspecialchars($dataDetail['nidn']));
            $tpl->replace("DATA_VAL_PHONE", htmlspecialchars($dataDetail['phone']));
            $tpl->replace("DATA_VAL_JOIN_DATE", $dataDetail['join_date']);
            $tpl->replace("DATA_BUTTON_NAME", "edit");
            $tpl->replace("DATA_BUTTON_TEXT", "Perbarui Dosen");
            $tpl->replace("DATA_CANCEL_BUTTON", "<a href='index.php' class='btn btn-outline-secondary'>Batal Edit</a>");
        } else {
            $tpl->replace("DATA_TITLE_FORM", "Tambah Dosen Baru");
            $tpl->replace("DATA_VAL_ID", "");
            $tpl->replace("DATA_VAL_NAME", "");
            $tpl->replace("DATA_VAL_NIDN", "");
            $tpl->replace("DATA_VAL_PHONE", "");
            $tpl->replace("DATA_VAL_JOIN_DATE", date('Y-m-d'));
            $tpl->replace("DATA_BUTTON_NAME", "add");
            $tpl->replace("DATA_BUTTON_TEXT", "Simpan Dosen");
            $tpl->replace("DATA_CANCEL_BUTTON", "");
        }

        $tpl->write();
    }
}
?>
