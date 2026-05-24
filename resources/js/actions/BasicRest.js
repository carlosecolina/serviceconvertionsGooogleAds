import axios from "axios"
import { Cookies, Fetch, Notify } from "sode-extend-react"

let controller = new AbortController()

class BasicRest {
  path = null

  paginate = async (params) => {
    controller.abort('Nothing')
    controller = new AbortController()
    const signal = controller.signal
    
    const res = await fetch(`/api/${this.path}/paginate`, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-Xsrf-Token': decodeURIComponent(Cookies.get('XSRF-TOKEN'))
      },
      body: JSON.stringify(params),
      signal
    })
    return await res.json()
  }

  save = async (client) => {
    try {
      const { status, result } = await Fetch(`/api/${this.path}`, {
        method: 'POST',
        body: JSON.stringify(client)
      })

      if (!status) throw new Error(result?.message || 'Ocurrio un error inesperado')

      Notify.add({
        icon: '/img_donas/icon.svg',
        title: 'Correcto',
        body: result.message,
        type: 'success'
      })
      return result
    } catch (error) {
      Notify.add({
        icon: '/img_donas/icon.svg',
        title: 'Error',
        body: error.message,
        type: 'danger'
      })
      return null
    }
  }

  status = async ({ id, status }) => {
    try {
      const { status: fetchStatus, result } = await Fetch(`/api/${this.path}/status`, {
        method: 'PATCH',
        body: JSON.stringify({ id, status })
      })
      if (!fetchStatus) throw new Error(result?.message ?? 'Ocurrio un error inesperado')

      Notify.add({
        icon: '/img_donas/icon.svg',
        title: 'Correcto',
        body: result.message,
        type: 'success'
      })

      return true
    } catch (error) {
      Notify.add({
        icon: '/img_donas/icon.svg',
        title: 'Error',
        body: error.message,
        type: 'danger'
      })

      return false
    }
  }
  boolean = async ({ id, field, value }) => {
    try {
      const { status: fetchStatus, result } = await Fetch(`/api/${this.path}/boolean`, {
        method: 'PATCH',
        body: JSON.stringify({ id, field, value })
      })
      if (!fetchStatus) throw new Error(result?.message ?? 'Ocurrio un error inesperado')

      Notify.add({
        icon: '/img_donas/icon.svg',
        title: 'Correcto',
        body: result.message,
        type: 'success'
      })

      return true
    } catch (error) {
      Notify.add({
        icon: '/img_donas/icon.svg',
        title: 'Error',
        body: error.message,
        type: 'danger'
      })

      return false
    }
  }

  delete = async (id) => {
    try {
      const { status: fetchStatus, result } = await Fetch(`/api/${this.path}/${id}`, {
        method: 'DELETE'
      })
      if (!fetchStatus) throw new Error(result?.message ?? 'Ocurrio un error inesperado')

      Notify.add({
        icon: '/img_donas/icon.svg',
        title: 'Correcto',
        body: result.message,
        type: 'success'
      })

      return true
    } catch (error) {
      Notify.add({
        icon: '/img_donas/icon.svg',
        title: 'Error',
        body: error.message,
        type: 'danger'
      })

      return false
    }
  }

  update = async (id, newOrder, values) => {
    console.log(id, newOrder)
     
    try {
      const response = await axios.post('/api/admin/updateorder', {
        id,
        
        newOrder,
        values
      });
      if (response.status == 200) {
        
        console.log('Order updated successfully:', response.data);

      }
    } catch (error) {
      console.error('Error updating order:', error);
    }
  }
}

export default BasicRest