<?php
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $uploadDir = 'uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $documentTypes = array(
            'student_photo' => 'Student Photo',
            'aadhar_card' => 'Aadhar Card',
            'marksheet' => 'Marksheet',
            'birth_certificate' => 'Birth Certificate',
            'income_certificate' => 'Income Certificate'
        );

        $uploadedDocuments = array();

        foreach ($documentTypes as $field => $documentType) {
            if (isset($_FILES[$field]) && $_FILES[$field]['error'] === 0) {
                $filename = $uploadDir . basename($_FILES[$field]['name']);
                if (move_uploaded_file($_FILES[$field]['tmp_name'], $filename)) {
                    $uploadedDocuments[] = array(
                        'type' => $documentType,
                        'file_name' => basename($_FILES[$field]['name'])
                    );
                }
            }
        }

        if (!empty($uploadedDocuments)) {
            echo '<h2>Uploaded Documents:</h2>';
            echo '<ul>';
            foreach ($uploadedDocuments as $document) {
                echo '<li>' . $document['type'] . ': ' . $document['file_name'] . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No documents uploaded.</p>';
        }
    }
    ?>