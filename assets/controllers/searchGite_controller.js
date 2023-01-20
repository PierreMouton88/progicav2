import { Controller } from '@hotwired/stimulus';

const $ = require('jquery');

import "select2";

import "select2/dist/css/select2.css";
export default class extends Controller {
    connect() {
       
        this.getEquipement('ext')
        this.getEquipement('int')
          
    }
    getEquipement(type){
        $('.eqp'+ type).select2({
            ajax: {
                url: '/gite/api/equipement/'+type,
                dataType: 'json',
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    data=JSON.parse(data);
                    return {
                      results : data
                    };
                  }
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
              }
        });
    }
 
}