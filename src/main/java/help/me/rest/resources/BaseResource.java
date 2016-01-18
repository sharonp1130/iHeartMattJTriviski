package help.me.rest.resources;

import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;
import javax.ws.rs.core.Response.ResponseBuilder;
import javax.ws.rs.core.Response.Status;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;

import help.me.orm.bo.IInfoBo;
import help.me.orm.bo.ILicenseBo;
import help.me.orm.bo.ISettingsBo;
import help.me.orm.bo.IUserBo;

public abstract class BaseResource {
	static Logger log = Logger.getLogger(BaseResource.class);
	
	@Autowired
	IUserBo userBo;

	@Autowired
	IInfoBo infoBo;
	
	@Autowired 
	ISettingsBo settingsBo;
	
	@Autowired
	ILicenseBo licenseBo;

	
	/**
	 * @param entity
	 * @param status
	 * @param mediaType
	 * @return new response object.
	 */
	protected Response response(Object entity, Status status, MediaType mediaType) {
		ResponseBuilder responseBuilder;
		if (entity == null) {
			responseBuilder = Response.status(status);
		} else {
			responseBuilder = Response.status(status).entity(entity);
		}
		
		if (mediaType != null) {
			responseBuilder.type(mediaType);
		}
		
		return responseBuilder.build();
	}
	
	/**
	 * Creates a response.  Media type is null, which means it is not set directly in 
	 * the response object.
	 * 
	 * @param entity
	 * @param status
	 * @return
	 */
	protected Response response(Object entity, Status status) {
		return response(entity, status, null);
	}

	
	/**
	 * Conv method to return an empty response with not found status.
	 * 
	 * @return Not found response.
	 */
	protected Response notFound() {
		return response(null, Status.NOT_FOUND);
	}

	/**
	 * @param entity
	 * @return
	 */
	protected Response notFound(Object entity) {
		return response(entity, Status.NOT_FOUND);
	}

	/**
	 * Conv method to send an ok response with entity as the object entity.
	 * 
	 * @param entity
	 * @return
	 */
	protected Response okay(Object entity) {
		return response(entity, Status.OK);
	}
	
	/**
	 * @return empty okay response.
	 */
	protected Response okay() {
		return response(null, Status.OK);
	}
	
	/**
	 * Used for a PUT when a new entity has been created.
	 * 
	 * @param entity
	 * @return created status with entity as the body.
	 */
	protected Response created(Object entity) {
		return response(entity, Status.CREATED);
	}

	/**
	 * Used for a PUT when a new entity has been created.
	 * 
	 * @return created status with entity empty body.
	 */
	protected Response created() {
		return response(null, Status.CREATED);
	}

	/**
	 * Any error will be a server error.  To include an entity use this method.
	 * 
	 * @param entity
	 * @return Response with an error status.
	 */
	protected Response serverError(Object entity, MediaType mediaType) {
		ResponseBuilder builder = Response.serverError().entity(entity);
		
		if (mediaType != null) {
			builder.type(mediaType);
		} 
		
		return builder.build();
	}
	
	/**
	 * Indicate there is an error.
	 * @return Response with an error status.
	 */
	protected Response serverError(MediaType mediaType) {
		return serverError(null, mediaType);
	}
	
	/**
	 * Sets the entity with the default media type.
	 * 
	 * @param entity
	 * @return
	 */
	protected Response serverError(Object entity) {
		return serverError(entity, null);
	}
}
