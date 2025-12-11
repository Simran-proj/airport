import axios from 'axios';

// Configuración base de la API
const API_BASE_URL = import.meta.env.VITE_API_URL || 'api';

// Crear instancia de axios con configuración base
const apiClient = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
  timeout: 10000, // 10 segundos timeout
});

// Interceptor para manejar errores globalmente
apiClient.interceptors.response.use(
  (response) => response.data,
  (error) => {
    console.error('API Error:', error.response?.data || error.message);
    
    // Manejo de errores HTTP comunes
    if (error.response) {
      switch (error.response.status) {
        case 401:
          console.error('No autorizado - Por favor inicie sesión');
          break;
        case 403:
          console.error('Acceso prohibido');
          break;
        case 404:
          console.error('Recurso no encontrado');
          break;
        case 422:
          console.error('Error de validación', error.response.data.errors);
          break;
        case 500:
          console.error('Error interno del servidor');
          break;
        default:
          console.error('Error HTTP:', error.response.status);
      }
    } else if (error.request) {
      console.error('No se pudo conectar con el servidor');
    } else {
      console.error('Error:', error.message);
    }
    
    return Promise.reject(error.response?.data || error.message);
  }
);

/**
 * Servicio para manejar reservas
 */
const ReservationService = {
  /**
   * Crear una nueva reserva
   * @param {Object} reservationData - Datos de la reserva
   * @returns {Promise}
   */
  createReservation(reservationData) {
    return apiClient.post('/reservas', reservationData);
  },

  /**
   * Buscar reserva por email y número de reserva
   * @param {string} email - Email del cliente
   * @param {string} reservationNumber - Número de reserva
   * @returns {Promise}
   */
  searchReservation(email, reservationNumber) {
    return apiClient.post('/reservas/buscar', {
      email,
      numero_reserva: reservationNumber
    });
  },

  /**
   * Obtener todas las reservas (solo para pruebas/admin)
   * @param {Object} params - Parámetros de paginación/filtrado
   * @returns {Promise}
   */
  getAllReservations(params = {}) {
    return apiClient.get('/reservas', { params });
  },

  /**
   * Obtener una reserva específica por ID
   * @param {number|string} id - ID de la reserva
   * @returns {Promise}
   */
  getReservationById(id) {
    return apiClient.get(`/reservas/${id}`);
  },

  /**
   * Actualizar una reserva
   * @param {number|string} id - ID de la reserva
   * @param {Object} updateData - Datos a actualizar
   * @returns {Promise}
   */
  updateReservation(id, updateData) {
    return apiClient.put(`/reservas/${id}`, updateData);
  }
};

/**
 * Servicio para administración de horarios
 */
const ScheduleService = {
  /**
   * Obtener todos los horarios disponibles
   * @param {Object} params - Parámetros de filtrado (fecha, etc.)
   * @returns {Promise}
   */
  getAvailableSchedules(params = {}) {
    return apiClient.get('/admin/horarios', { params });
  },

  /**
   * Crear un nuevo horario
   * @param {Object} scheduleData - Datos del horario
   * @returns {Promise}
   */
  createSchedule(scheduleData) {
    return apiClient.post('/admin/horarios', scheduleData);
  },

  /**
   * Obtener un horario específico
   * @param {number|string} id - ID del horario
   * @returns {Promise}
   */
  getScheduleById(id) {
    return apiClient.get(`/admin/horarios/${id}`);
  },

  /**
   * Actualizar un horario
   * @param {number|string} id - ID del horario
   * @param {Object} updateData - Datos a actualizar
   * @returns {Promise}
   */
  updateSchedule(id, updateData) {
    return apiClient.put(`/admin/horarios/${id}`, updateData);
  },

  /**
   * Eliminar un horario
   * @param {number|string} id - ID del horario
   * @returns {Promise}
   */
  deleteSchedule(id) {
    return apiClient.delete(`/admin/horarios/${id}`);
  }
};

/**
 * Servicio para validar horarios disponibles
 */
const AvailabilityService = {
  /**
   * Verificar disponibilidad de horarios
   * @param {string} date - Fecha en formato YYYY-MM-DD
   * @param {string} time - Hora en formato HH:MM
   * @returns {Promise}
   */
  checkAvailability(date, time) {
    return ScheduleService.getAvailableSchedules({ date, time });
  },

  /**
   * Obtener horarios disponibles para una fecha
   * @param {string} date - Fecha en formato YYYY-MM-DD
   * @returns {Promise}
   */
  getAvailableTimes(date) {
    return ScheduleService.getAvailableSchedules({ date });
  }
};

/**
 * Servicio para utilidades comunes
 */
const UtilityService = {
  /**
   * Formatear fecha para la API
   * @param {Date|string} date - Fecha a formatear
   * @returns {string} Fecha en formato YYYY-MM-DD HH:MM:SS
   */
  formatDateForApi(date) {
    const d = new Date(date);
    return d.toISOString().slice(0, 19).replace('T', ' ');
  },

  /**
   * Validar formato de hora permitido (09:00, 12:00, 16:00)
   * @param {string} time - Hora en formato HH:MM
   * @returns {boolean}
   */
  isValidTime(time) {
    const validTimes = ['09:00', '12:00', '16:00'];
    return validTimes.includes(time);
  },

  /**
   * Extraer hora de un datetime
   * @param {string} datetime - Datetime en formato ISO
   * @returns {string} Hora en formato HH:MM
   */
  extractTime(datetime) {
    if (!datetime) return '';
    const date = new Date(datetime);
    return date.toTimeString().slice(0, 5);
  },

  /**
   * Extraer fecha de un datetime
   * @param {string} datetime - Datetime en formato ISO
   * @returns {string} Fecha en formato YYYY-MM-DD
   */
  extractDate(datetime) {
    if (!datetime) return '';
    const date = new Date(datetime);
    return date.toISOString().slice(0, 10);
  },
  
};

// Exportar todos los servicios
export default {
  reservations: ReservationService,
  schedules: ScheduleService,
  availability: AvailabilityService,
  utils: UtilityService,
  
  // Métodos directos para uso rápido
  createReservation: ReservationService.createReservation,
  searchReservation: ReservationService.searchReservation,
  checkAvailability: AvailabilityService.checkAvailability,
  formatDate: UtilityService.formatDateForApi
};