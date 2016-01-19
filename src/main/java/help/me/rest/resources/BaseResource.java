package help.me.rest.resources;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;

import javax.ws.rs.WebApplicationException;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;
import javax.ws.rs.core.Response.ResponseBuilder;
import javax.ws.rs.core.Response.Status;
import javax.ws.rs.core.StreamingOutput;

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
		return okay(entity, null);
	}
	
	/**
	 * @param entity
	 * @param mediaType
	 * @return
	 */
	protected Response okay(Object entity, MediaType mediaType) {
		return response(entity, Status.OK, mediaType);
	}
	
	/**
	 * @return empty okay response.
	 */
	protected Response okay() {
		return okay(null, null);
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

	/**
	 * @param inputFile File to stream as part of the StreamingOutput
	 * @return MinimalStreamOutput that will stream the contents of inputFile
	 * @throws FileNotFoundException
	 */
	protected StreamingOutput getStreamingOutput(File inputFile) throws FileNotFoundException {
		return getStreamingOutput(new FileInputStream(inputFile));
	}

	/**
	 * @param inputStream
	 * @return MinimalStreamingOutput to stream the inputStream.
	 */
	protected StreamingOutput getStreamingOutput(final InputStream inputStream) {
		MinimalStreamingOutput stream = new MinimalStreamingOutput(inputStream);
		
		return stream;
	}
	
	/**
	 * Minimal implementation.  Reads the contents from sourceStream and writes it into output.
	 * 
	 * 
	 * @author triviski
	 *
	 */
	public class MinimalStreamingOutput implements StreamingOutput {
		private InputStream sourceStream;
		private boolean closeStream;
		
		/**
		 * This will always close the sourceStream when finished with the write method.
		 * @param sourceStream
		 */
		public MinimalStreamingOutput(InputStream sourceStream) {
			this(sourceStream, true);
		}
			
		/**
		 * 
		 * @param sourceStream
		 * @param closeStream if true will close the stream when finished with the write method.
		 */
		public MinimalStreamingOutput(InputStream sourceStream, boolean closeStream) {
			super();
			this.sourceStream = sourceStream;
			this.closeStream = closeStream;
		}

		
		/* (non-Javadoc)
		 * @see javax.ws.rs.core.StreamingOutput#write(java.io.OutputStream)
		 */
		@Override
		public void write(OutputStream output) throws IOException, WebApplicationException {
			try {
				byte[] buf = new byte[4096];
				
				int bytesRead;
				
				do {
					bytesRead = sourceStream.read(buf);
					
					if (bytesRead > 0) {
						output.write(buf, 0, bytesRead);
					}
				} while (bytesRead > 0);
			} finally {
				if (closeStream) {
					sourceStream.close();
				}
			}
		}
	}
}
