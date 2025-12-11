import { ref } from 'vue';
import api from '../services/api.js';

export function useApi() {
  const loading = ref(false);
  const error = ref(null);
  const data = ref(null);

  /**
   * Ejecutar una operación de API con manejo de estado
   * @param {Function} apiCall - Función que retorna una promesa de API
   * @param {*} params - Parámetros para la función
   * @returns {Promise}
   */
  const execute = async (apiCall, ...params) => {
    loading.value = true;
    error.value = null;
    
    try {
      const response = await apiCall(...params);
      data.value = response;
      return response;
    } catch (err) {
      error.value = err;
      console.error('API operation failed:', err);
      throw err;
    } finally {
      loading.value = false;
    }
  };

  /**
   * Resetear el estado
   */
  const reset = () => {
    loading.value = false;
    error.value = null;
    data.value = null;
  };

  return {
    loading,
    error,
    data,
    execute,
    reset
  };
}

// Composables específicos para cada servicio
export function useReservationApi() {
  const apiState = useApi();

  const createReservation = async (reservationData) => {
    return apiState.execute(api.reservations.createReservation, reservationData);
  };

  const searchReservation = async (email, reservationNumber) => {
    return apiState.execute(api.reservations.searchReservation, email, reservationNumber);
  };

  return {
    ...apiState,
    createReservation,
    searchReservation
  };
}

export function useScheduleApi() {
  const apiState = useApi();

  const getAvailableTimes = async (date) => {
    return apiState.execute(api.availability.getAvailableTimes, date);
  };

  const checkAvailability = async (date, time) => {
    return apiState.execute(api.availability.checkAvailability, date, time);
  };

  return {
    ...apiState,
    getAvailableTimes,
    checkAvailability
  };
}