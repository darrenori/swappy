<?php

// Check an uploaded file is an image we allow and within the size limit. Reads the real
// bytes with finfo rather than trusting the client supplied type. Returns a list of errors,
// empty means fine.
function validateUpload(array $file): array
{
    $errors = [];
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        $errors[] = 'upload failed';
        return $errors;
    }
    if ($file['size'] > MAX_UPLOAD_BYTES) {
        $errors[] = 'file too big';
    }
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);
    if (!in_array($mime, ALLOWED_IMAGE_TYPES, true)) {
        $errors[] = 'not an allowed image type';
    }
    return $errors;
}
