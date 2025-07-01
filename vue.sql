-- Vue departement
CREATE VIEW v_departement AS
SELECT 
    d.dept_no AS Numero,
    d.dept_name AS Departement,
    CONCAT(e.first_name, ' ', e.last_name) AS Manager,
    COUNT(de.emp_no) AS nb_employes
FROM 
    departments d
JOIN 
    dept_manager dm ON d.dept_no = dm.dept_no
JOIN 
    employees e ON dm.emp_no = e.emp_no
LEFT JOIN 
    current_dept_emp de ON d.dept_no = de.dept_no
WHERE 
    dm.to_date = '9999-01-01'
GROUP BY 
    d.dept_no, d.dept_name, e.first_name, e.last_name
ORDER BY 
    d.dept_no;
