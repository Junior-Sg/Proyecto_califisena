<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        /* ======== FOOTER CALIFISENA ======== */
footer {
  background: linear-gradient(135deg, #0c6c3c, #087a43);
  color: #ffffff;
  text-align: center;
  padding: 25px 15px;
  font-family: 'Segoe UI', Arial, sans-serif;
  font-size: 15px;
  line-height: 1.6;
  position: relative;
  width: 100%;
  bottom: 0;
  border-top: 3px solid rgba(255, 255, 255, 0.15);
  box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.1);
}

/* Animación sutil de brillo en el texto */
footer p {
  margin: 5px 0;
  letter-spacing: 0.5px;
  transition: color 0.3s ease, text-shadow 0.3s ease;
}

footer p:hover {
  color: #e0ffe8;
  text-shadow: 0 0 6px rgba(255, 255, 255, 0.3);
}

/* Línea decorativa animada */
footer::before {
  content: "";
  position: absolute;
  top: 0;
  left: 50%;
  width: 120px;
  height: 3px;
  background-color: rgba(255, 255, 255, 0.4);
  border-radius: 2px;
  transform: translateX(-50%);
  animation: shine 3s infinite ease-in-out;
}

@keyframes shine {
  0%, 100% {
    width: 60px;
    opacity: 0.3;
  }
  50% {
    width: 140px;
    opacity: 1;
  }
}

/* ======== RESPONSIVE ======== */
@media (max-width: 768px) {
  footer {
    font-size: 14px;
    padding: 20px 10px;
  }
}

@media (max-width: 480px) {
  footer {
    font-size: 13px;
    padding: 18px 8px;
  }
}

    </style>
</head>
<body>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> CalifiSena. todos los derechos reservados .</p>
        <p>Creado por ADSO 2978583</p>
    </footer>
</body>
</html>