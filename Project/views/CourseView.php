<?php

include_once("Template.php");

class CourseView
{
    public function render($data, $dataDetail = null)
    {
        $no = 1;
        $dataCourse = "";
        $dataLecturerOption = "";
        $dataDepartmentOption = "";

        if (empty($data['course'])) {
            $dataCourse = "<tr><td colspan='7' class='text-center py-4 text-muted'>Belum ada data mata kuliah.</td></tr>";
        } else {
            foreach ($data['course'] as $val) {
                $id = $val['id'];
                $code = htmlspecialchars($val['code']);
                $name = htmlspecialchars($val['name']);
                $sks = (int)$val['sks'];
                $semester = (int)$val['semester'];
                $lecturer_name = !empty($val['lecturer_name']) ? htmlspecialchars($val['lecturer_name']) : "<span class='text-muted fst-italic'>Belum diatur</span>";
                $dept_name = !empty($val['department_name']) ? htmlspecialchars($val['department_name']) : "<span class='text-muted fst-italic'>Belum diatur</span>";

                $dataCourse .= "<tr>
                    <td class='ps-3 text-secondary'>{$no}</td>
                    <td><span class='badge bg-light text-dark border font-monospace'>{$code}</span></td>
                    <td class='fw-semibold text-dark'>{$name}</td>
                    <td><span class='badge bg-secondary bg-opacity-25 text-dark'>{$sks} SKS / Sem {$semester}</span></td>
                    <td>{$lecturer_name}</td>
                    <td><span class='badge bg-primary bg-opacity-10 text-primary'>{$dept_name}</span></td>
                    <td class='text-center'>
                        <a href='course.php?id_edit={$id}' class='btn btn-sm btn-outline-warning me-1' title='Edit Mata Kuliah'>
                            <i class='fa-solid fa-pen-to-square'></i> Edit
                        </a>
                        <a href='course.php?id_hapus={$id}' class='btn btn-sm btn-outline-danger' title='Hapus Mata Kuliah' onclick=\"return confirm('Yakin ingin menghapus mata kuliah ini?')\">
                            <i class='fa-solid fa-trash-can'></i> Hapus
                        </a>
                    </td>
                </tr>";
                $no++;
            }
        }

        $selectedLecturerId = $dataDetail ? $dataDetail['lecturer_id'] : null;
        if (!empty($data['lecturer'])) {
            foreach ($data['lecturer'] as $lec) {
                $lecId = $lec['id'];
                $lecName = htmlspecialchars($lec['name']);
                $isSelected = ($selectedLecturerId == $lecId) ? "selected" : "";
                $dataLecturerOption .= "<option value='{$lecId}' {$isSelected}>{$lecName}</option>";
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

        $tpl = new Template("templates/course.html");
        $tpl->replace("DATA_TITLE", "Courses");
        $tpl->replace("DATA_TABEL", $dataCourse);
        $tpl->replace("DATA_LECTURER_OPTION", $dataLecturerOption);
        $tpl->replace("DATA_DEPARTMENT_OPTION", $dataDepartmentOption);

        if ($dataDetail) {
            $tpl->replace("DATA_TITLE_FORM", "Ubah Mata Kuliah");
            $tpl->replace("DATA_VAL_ID", $dataDetail['id']);
            $tpl->replace("DATA_VAL_CODE", htmlspecialchars($dataDetail['code']));
            $tpl->replace("DATA_VAL_NAME", htmlspecialchars($dataDetail['name']));
            $tpl->replace("DATA_VAL_SKS", $dataDetail['sks']);
            $tpl->replace("DATA_VAL_SEMESTER", $dataDetail['semester']);
            $tpl->replace("DATA_BUTTON_NAME", "edit");
            $tpl->replace("DATA_BUTTON_TEXT", "Perbarui Mata Kuliah");
            $tpl->replace("DATA_CANCEL_BUTTON", "<a href='course.php' class='btn btn-outline-secondary'>Batal Edit</a>");
        } else {
            $tpl->replace("DATA_TITLE_FORM", "Tambah Mata Kuliah");
            $tpl->replace("DATA_VAL_ID", "");
            $tpl->replace("DATA_VAL_CODE", "");
            $tpl->replace("DATA_VAL_NAME", "");
            $tpl->replace("DATA_VAL_SKS", "3");
            $tpl->replace("DATA_VAL_SEMESTER", "3");
            $tpl->replace("DATA_BUTTON_NAME", "add");
            $tpl->replace("DATA_BUTTON_TEXT", "Simpan Mata Kuliah");
            $tpl->replace("DATA_CANCEL_BUTTON", "");
        }

        $tpl->write();
    }
}
?>
