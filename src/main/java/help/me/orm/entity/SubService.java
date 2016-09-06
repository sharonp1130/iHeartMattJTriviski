//package help.me.orm.entity;
//
//import javax.persistence.CascadeType;
//import javax.persistence.Column;
//import javax.persistence.Entity;
//import javax.persistence.FetchType;
//import javax.persistence.GeneratedValue;
//import javax.persistence.Id;
//import javax.persistence.JoinColumn;
//import javax.persistence.OneToOne;
//import javax.persistence.Table;
//import javax.persistence.UniqueConstraint;
//
//import org.hibernate.annotations.GenericGenerator;
//
//@SuppressWarnings("serial")
//@Entity
//@Table(name = "subservice", uniqueConstraints = @UniqueConstraint(columnNames = "description") )
//public class SubService implements java.io.Serializable {
//
//	private int subServiceId;
//	private String description;
//	private String iconFileName;
//
//	private Service service;
//	
//	public SubService() {}
//
//	public SubService(int subServiceId, String description, String iconFileName, Service service) {
//		super();
//		this.subServiceId = subServiceId;
//		this.description = description;
//		this.iconFileName = iconFileName;
//		this.service = service;
//	}
//	
//	/**
//	 * For jackson
//	 * 
//	 * @param description
//	 */
//	public SubService(String description) {
//		this(-1, description, null, null);
//	}
//
//	@Id
//	@GeneratedValue(generator="sub-serviceIncrement")
//	@GenericGenerator(name="sub-serviceIncrement", strategy = "increment")
//	@Column(name = "serviceId", unique = true, nullable = false)
//	public int getServiceId() {
//		return this.subServiceId;
//	}
//
//	public void setServiceId(int subServiceId) {
//		this.subServiceId = subServiceId;
//	}
//
//	@Column(name = "description", unique = true, nullable = false, length = 100)
//	public String getDescription() {
//		return this.description;
//	}
//
//	public void setDescription(String description) {
//		this.description = description;
//	}
//
//	@Column(name = "iconFileName", unique = false, nullable = false, length = 100)
//	public String getIconFileName() {
//		return this.iconFileName;
//	}
//	
//	public void setIconFileName(String iconFileName) {
//		this.iconFileName = iconFileName;
//	}
//
//	@JoinColumn(name = "service")
//	@OneToOne(fetch=FetchType.EAGER, cascade=CascadeType.ALL)
//	public Service getService() {
//		return this.service;
//	}
//
//	public void setService(Service service) {
//		this.service = service;
//	}
//
//}
